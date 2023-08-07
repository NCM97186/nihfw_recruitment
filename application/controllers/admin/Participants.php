
<?php

class Participants extends CI_Controller
{
  function __construct() {
    parent::__construct();
	 $this->admin_info     =  $this->common->__check_session();
    $this->load->model('Participants_model');
	$this->load->model('Users_model','users');
	$this->load->model('JobPost_model','jobpost'); 
	$this->load->model('Users_model','users');
		$this->load->model('Participants_model');
		$this->load->model('Advertisement_model');
		$this->load->model('JobPost_model');
		$this->load->model('Category_model');
    //$this->load->model('Candidate_view_model');
    }


  public function backup()
  {

    $data = array();
    $data['results']=$this->Participants_model->get_list();
    //print_r($data);die;
    loadLayout('admin/participants', $data, 'admin');
  }
  
  public function index()
  {
		if(isset($_REQUEST['advertisement_ID']) && $_REQUEST['advertisement_ID'] != 0){
			$advertise = $_REQUEST['advertisement_ID'];
		}else{
			$advertise = '';
		}

		if(isset($_REQUEST['Post_ID']) && $_REQUEST['Post_ID'] != 0){
			$postid = $_REQUEST['Post_ID'];
		}else{
			$postid = '';
		}

		if(isset($_REQUEST['Category_ID']) && $_REQUEST['Category_ID'] != 0){
			$category_id = $_REQUEST['Category_ID'];
		}else{
			$category_id = '';
		}

		if(isset($_REQUEST['Gender_ID']) && $_REQUEST['Gender_ID'] != 0){
			$gender_id = $_REQUEST['Gender_ID'];
		}else{
			$gender_id = '';
		}

		if(isset($_REQUEST['StatusFilter_ID']) && $_REQUEST['StatusFilter_ID'] != 0){
			$status_id = $_REQUEST['StatusFilter_ID'];
		}else{
			$status_id = '';
		}

		if(isset($_REQUEST['adver_datef']) && isset($_REQUEST['adver_datet'])){
			$fromdate = $_REQUEST['adver_datef'];
			$todate = $_REQUEST['adver_datet'];
		}else{
			$fromdate = '';
			$todate = '';
		}
		$export='';
       $data = array();
	   $query=$this->db->get('cand_profile_status_master');
	   $data['candprofilestatus']=$query->result();
		$data['advertisement'] = $this->Advertisement_model->get_list();
		$data['jobpost'] = $this->JobPost_model->get_list(); 
		$data['category'] = $this->Category_model->get_list();
        $data['results']=$this->users->get_user_lists($advertise,$postid,$gender_id,$category_id,$status_id,$fromdate, $todate,$export);
    // print_r($data);die;
	//$data['results'] = $this->Participants_model->get_filteredlist($advertise,$postid,$gender_id,$category_id,$status_id,$fromdate, $todate,$export);
      
    loadLayout('admin/participants_lists', $data, 'admin');
  }
  public function exportcsv(){ 
	//csv file name
	$filename = 'Participants_'.date('Ymd').'.csv';
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=$filename");
	header("Content-Type: application/csv; "); 
	if(isset($_REQUEST['advertisement_ID']) && $_REQUEST['advertisement_ID'] != 0){
		$advertise = $_REQUEST['advertisement_ID'];
	}else{
		$advertise = '';
	}

	if(isset($_REQUEST['Post_ID']) && $_REQUEST['Post_ID'] != 0){
		$postid = $_REQUEST['Post_ID'];
	}else{
		$postid = '';
	}

	if(isset($_REQUEST['Category_ID']) && $_REQUEST['Category_ID'] != 0){
		$category_id = $_REQUEST['Category_ID'];
	}else{
		$category_id = '';
	}

	if(isset($_REQUEST['Gender_ID']) && $_REQUEST['Gender_ID'] != 0){
		$gender_id = $_REQUEST['Gender_ID'];
	}else{
		$gender_id = '';
	}

	if(isset($_REQUEST['StatusFilter_ID']) && $_REQUEST['StatusFilter_ID'] != 0){
		$status_id = $_REQUEST['StatusFilter_ID'];
	}else{
		$status_id = '';
	}

	if(isset($_REQUEST['adver_datef']) && isset($_REQUEST['adver_datet'])){
		$fromdate = $_REQUEST['adver_datef'];
		$todate = $_REQUEST['adver_datet'];
	}else{
		$fromdate = '';
		$todate = '';
	}
	$export='csv';
	// get data
	$applicants = $this->users->get_user_lists($advertise,$postid,$gender_id,$category_id,$status_id,$fromdate, $todate,$export);
   
	// file creation
	$file = fopen('php://output', 'w');
	$header =     array ( "application_id", "name", "status_id", "post_id", "benchmark", "department", "category_name", "category_attachment", "person_disability", "add_disablity", "dob", "dob_doc", "gender", "marital_status", "father_name", "mother_name", "identity_proof", "adhar_card_number", "adhar_card_doc", "corr_address", "corr_state", "corr_pincode", "perm_address", "perm_state", "perm_pincode", "photograph", "signature", "deg", "year", "sub", "uni", "div", "per", "file_path", "to_date", "organization", "post_held", "pay_scale", "from_date", "post_name", "adver_no", "adver_title");
	fputcsv($file, $header);

	foreach ($applicants as $key=>$line){
		//print_r($line['dob_doc']);
	   fputcsv($file,$line);
	}

	fclose($file);
	exit;
}

  public function insertData(){
    $data=array();
    $data['cand_id']= $_POST['cand_id'];
    $data['status_id']=$_POST['status_id'];
    $data['by_admin_id']=$this->session->userdata()['ADMIN']['admin_id'];
    $t=$this->Participants_model->only_insert($data);
    if($t==1){
      echo "Candidate Status updated Sucessfully";
    }
  }
  public function view($cand_id)
  {

    $data = array();
    $data['results']=$this->Participants_model->get_candidate($cand_id);
	
    $data['qualification']=$this->Participants_model->getQualification($cand_id);
	 /* echo "<pre>";
	print_r($data['results']);
	print_r($data['qualification']);
	die;  */
    loadLayout('admin/participant_view', $data, 'admin');
  }
  
   public function editlist($user_id)
  {
    $data = array();
	if(!empty($user_id)){
		$data['user_details']  = $this->users->get_user_details($user_id);
			
		    $data['post_detail']  = $this->users->get_candidate($user_id); 
	 		$data['basic_info']  = $this->users->get_basicInfo($user_id);  
			$data['degree_diploma']  = $this->users->get_user_degree_diploma($user_id);
			$data['work_experience']  = $this->users->get_user_work_experience($user_id);
			$data['get_job_list']  = $this->jobpost->get_list();
			 if($this->input->post()) {
		  
			$post_val = $this->input->post();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('category', 'Category', 'required');
			if($this->input->post('category')=='1') {
				$this->form_validation->set_rules('category_name', 'Category', 'required');
				if(empty($_FILES['category_attachment']['name'])&&empty($this->input->post('old_category_attachment'))) {
					$this->form_validation->set_rules('category_attachment', 'Person Disability', 'required');
				}
			}
			
			if($this->input->post('dob')!=''&&$this->input->post('post_id')) {
						$dob_age="";
						$post_detail  = $this->users->get_candidate_dob($this->input->post('dob'),$this->input->post('post_id')); 
						
						if(!empty($this->input->post('dob'))&&isset($post_detail->max_age_date)&&isset($post_detail->min_age_date)){
							$dob_age=cal_diff_date($post_detail->max_age_date,$post_detail->min_age_date,$this->input->post('dob'));
						}
						
						if($dob_age!=true){
							if($dob_age=='max'){
								$this->session->set_flashdata('error', 'Your Age is max from requirement.');
							}elseif($dob_age=='min'){
								$this->session->set_flashdata('error', 'Your Age is less from requirement');
							}else{
								$this->session->set_flashdata('error', 'Your Age is null');
							}
						redirect( base_url('dashboard/details'));
						}
			}
			$this->form_validation->set_rules('benchmark', 'Benchmark', 'required');
			if($this->input->post('benchmark')=='Yes') {
				if(empty($_FILES['person_disability']['name'])&&empty($this->input->post('old_person_disability'))) {
					$this->form_validation->set_rules('person_disability', 'Person Disability', 'required');
				}
			}
			if($this->input->post('adhar_card_number')!='') {
				if(empty($_FILES['adhar_card_doc']['name'])&&empty($this->input->post('old_adhar_card_doc'))) {
					$this->form_validation->set_rules('adhar_card_doc', 'Adhar Card Doc', 'required');
				}
			}
			
			$this->form_validation->set_rules('dob', 'DOB', 'required');
			$this->form_validation->set_rules('gender', 'Gender ', 'required');
			$this->form_validation->set_rules('marital_status', 'Marital status', 'required');
			$this->form_validation->set_rules('father_name', 'Father name', 'required');
			$this->form_validation->set_rules('mother_name', 'Mother name', 'required');
			$this->form_validation->set_rules('adhar_card_number', 'Adhar Card Number', 'required');
			$this->form_validation->set_rules('corr_address', 'Corresponding Address', 'required');
			$this->form_validation->set_rules('corr_state', 'State', 'required');
			$this->form_validation->set_rules('corr_pincode', 'Pincode', 'required');
			//$this->form_validation->set_rules('degree_diploma[]', 'Degree/Diploma', 'required');
			//$this->form_validation->set_rules('year[]', 'Year', 'required');
			//$this->form_validation->set_rules('university[]', 'University', 'required');
			//$this->form_validation->set_rules('division[]', 'Division', 'required');
			if(empty($_FILES['person_disability']['name'])&&empty($this->input->post('old_photo'))) {
				$this->form_validation->set_rules('photograph', 'Photograph', 'required');
			}
			if(empty($_FILES['person_disability']['name'])&&empty($this->input->post('old_sign'))) {
				$this->form_validation->set_rules('signature', 'Signature', 'required');
			}
			
		}
		if($this->form_validation->run() != FALSE){
			if(isset($_FILES['category_attachment']) && $_FILES['category_attachment']['name'] != '') {
					$file_name = time() . '_' . $_FILES["category_attachment"]['name'];
					$config['upload_path'] = '/var/www/html/NIHFW_VACANCY/uploads/category_attachment/';
					$config['allowed_types'] = 'doc|docx|pdf|jpg|jpeg|png';
					$config['max_size'] = '3072';
					$config['file_name'] = $file_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('category_attachment')) {
						$upload_data = $this->upload->data();
						$category_attachment = $upload_data['file_name'];
						$post_val['category_attachment']=$category_attachment;
					} else {
						$error = array('error' => $this->upload->display_errors());
						$label="Category Attachment";
					}
			}
			
			if(isset($_FILES['adhar_card_doc']) && $_FILES['adhar_card_doc']['name'] != '') {
					$file_name = time() . '_' . $_FILES["adhar_card_doc"]['name'];
					$config['upload_path'] = '/var/www/html/NIHFW_VACANCY/uploads/adhar_card_doc/';
					$config['allowed_types'] = 'doc|docx|pdf|jpg|jpeg|png';
					$config['max_size'] = '3072';
					$config['file_name'] = $file_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('adhar_card_doc')) {
						$upload_data = $this->upload->data();
						$adhar_card_doc = $upload_data['file_name'];
						$post_val['adhar_card_doc']=$adhar_card_doc;
					} else {
						$error = array('error' => $this->upload->display_errors());
						$label="Adhar Card Doc";
					}
			}
			if(isset($_FILES['person_disability']) && $_FILES['person_disability']['name'] != '') {
					$file_name = time() . '_' . $_FILES["person_disability"]['name'];
					$config['upload_path'] = '/var/www/html/NIHFW_VACANCY/uploads/person_disability/';
					$config['allowed_types'] = 'doc|docx|pdf|jpg|jpeg|png';
					$config['max_size'] = '3072';
					$config['file_name'] = $file_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('person_disability')) {
						$upload_data = $this->upload->data();
						$person_disability = $upload_data['file_name'];
						$post_val['person_disability']=$person_disability;
					} else {
						$error = array('error' => $this->upload->display_errors());
						$label="Person Disability";
					}
			}
			if(isset($_FILES['photograph']) && $_FILES['photograph']['name'] != '') {
					$file_name = time() .'_'. $_FILES["photograph"]['name'];
					$config['upload_path'] = '/var/www/html/NIHFW_VACANCY/uploads/photograph/';
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = '3072';
					$config['file_name'] = $file_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('photograph')) {
						$upload_data = $this->upload->data();
						$photograph = $upload_data['file_name'];
						$post_val['photograph']=$photograph;
					} else {
						$error = array('error' => $this->upload->display_errors());
						$label="Photograph";
					}
					
			}
			if(isset($_FILES['signature']) && $_FILES['signature']['name'] != '') {
					$file_name = time() . '_' . $_FILES["signature"]['name'];
					$config['upload_path'] = '/var/www/html/NIHFW_VACANCY/uploads/signature/';
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = '3072';
					$config['file_name'] = $file_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('signature')) {
						$upload_data = $this->upload->data();
						$signature = $upload_data['file_name'];
						$post_val['signature']=$signature;
					} else {
						$error = array('error' => $this->upload->display_errors());
						$label="Signature";
					}
					
			}
					if((empty($category_attachment)||empty($person_disability)||empty($photograph)||empty($signature))){
						if(isset($error)&&count($error)>0){
							foreach($error as $err){
								$this->session->set_flashdata('error', $label."! ".$err);
								redirect( base_url('dashboard/details'));
							}
						}
					}
					
					$user_data['registration_number']=$post_val['registration_number'];
					$user_data['first_name']=$post_val['first_name'];
					$user_data['middel_name']=$post_val['middel_name'];
					$user_data['last_name']=$post_val['last_name'];
					$user_data['cand_mob']=$post_val['cand_mob'];
					$user_data['cand_email']=$post_val['cand_email'];
					if(isset($post_val['first_name'])&&!empty($post_val['first_name'])){
							$this->users->update_all_users($user_id,$user_data);
					}
					$post_val['user_id']=$user_id;
					if(isset($post_val['degree_diploma'])&&!empty($post_val['degree_diploma'])){
						$degree_diploma=$post_val['degree_diploma'];
						$this->users->insert_degree_diploma_details($user_id,$degree_diploma);
					}
					if(isset($post_val['work_experience'])&&!empty($post_val['work_experience'])){
						$experience=$post_val['work_experience'];
						$this->users->insert_work_experience_details($user_id,$experience);
					}
					unset($post_val['old_category_attachment']);
					unset($post_val['old_person_disability']);
					unset($post_val['old_photo']);
					unset($post_val['old_sign']);
					unset($post_val['old_adhar_card_doc']);
					unset($post_val['validate']);
					unset($post_val['degree_diploma']);
					unset($post_val['work_experience']);
					unset($post_val['registration_number']);
					unset($post_val['first_name']);
					unset($post_val['middel_name']);
					unset($post_val['last_name']);
					unset($post_val['cand_mob']);
					unset($post_val['cand_email']);
					if(isset($data['user_details']->id)&&!empty($data['user_details']->id)){
							$user_detail_id=$data['user_details']->id;
							$this->users->update_user_details($user_id,$post_val);
					}else{
						$this->users->insert_update_user_details($post_val);
							
						}
						
      $this->session->set_flashdata('success', 'Data saved Successfully');
			redirect( base_url('admin/participants/editlist/'.$user_id));
			
		}
	}
    loadLayout('admin/participant_edit_lists', $data, 'admin');
  }
  public function viewlist($cand_id)
  {
	$res= explode('_',$cand_id);
	 $user_id = $res[1];
	 $application_id= $res[0];
	//  echo $application_id;
	// die();
	
    $data = array();
	$data['user_details']  = $this->users->get_user_details($application_id);
	$data['basic_info']  = $this->users->get_basicInfo($user_id);
	$data['post_detail']  = $this->users->get_candidate($user_id);  
	$data['degree_diploma']  = $this->users->get_user_degree_diploma($application_id);
	$data['work_experience']  = $this->users->get_user_work_experience($application_id);
	$data['get_job_list']  = $this->jobpost->get_list();
	//    echo "<pre>";
	// //   echo "hii";
	// print_r($data['degree_diploma']);
	// // // print_r($data['qualification']);
	//   die;  
    loadLayout('admin/participant_view_lists', $data, 'admin');
  }
	public function participantstatus($application)
	{
		// echo $application;
		// die();
	$application = explode('_',$application);
	$user_id = $application[1];
	$application_id = $application[0];

		$post_val = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('status_id', 'status_id', 'required');
		$this->form_validation->set_rules('varify_comment', 'Comment', 'required');
				
		if($this->form_validation->run() != FALSE)
		{
			
			$update = array('status_id' => $post_val['status_id']);
			$where = array('application_id' => $application_id); 
			$res = $this->db->where($where)->update('users_detail', $update);
			if($res)
			{
				$result['cand_id']= $application_id;
				$result['status_id']= $post_val['status_id'];
				$result['varify_comment']=$post_val['varify_comment'];
				$result['by_admin_id']=$this->session->userdata()['ADMIN']['admin_id'];
				$t=$this->Participants_model->only_insert($result);
				$this->session->set_flashdata('success', 'Data saved Successfully');
				//redirect('admin/participants/');
				redirect('admin/Participants/viewlist/'.$application_id.'_'.$user_id);
			}
		}else{
			$this->session->set_flashdata('error', 'Comment Required');
				redirect('admin/Participants/viewlist/'.$application_id.'_'.$user_id);
           
			
		}
			
  }

  /*------------------ End of Target Functions ----------*/
  public function delete_participant($user_id)
  {
	  if(!empty($user_id)){
				$this->db->where('user_id',$user_id);
				$this->db->delete('users');
				
				$this->db->where('user_id',$user_id);
				$this->db->delete('users_detail');
				
				$this->db->where('user_id',$user_id);
				$this->db->delete('users_work_experience');
				
				$this->db->where('user_id',$user_id);
				$this->db->delete('users_degree');
	  }
  }
}
