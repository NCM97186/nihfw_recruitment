<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
        parent::__construct();

        $this->user_info     =  $this->common->__check_user_session();
        $this->load->model('Users_model','users');
		$this->load->model('JobPost_model','jobpost'); 
    }
	
	public function basicinfo()
	{

	  $data = null;
	  $user_id = $_SESSION['USER']['user_id'];
	  if($this->input->post('basicinfo')) {
			$post_val = $this->input->post();
			$update_array = array(
				'first_name' => $post_val['first_name'],
				'middel_name' => $post_val['middel_name'],
				'last_name' => $post_val['last_name']
				);
			$this->db->where("user_id",$user_id);	
			$this->db->update("users",$update_array);			
			$this->session->set_flashdata('success', 'Data saved Successfully');
			redirect( base_url('dashboard/details'));
		}
		if($user_id != 0) {	
			$data['basic_info']  = $this->users->get_basicInfo($user_id);  
		}
	  loadLayout('user/basicInfo', $data);
	}

	public function photo_signature()
	{
      $user_id = $_SESSION['USER']['user_id'];
	  $data = null;
	  
	  if($this->input->post('photo_sign')) {	 
			$this->load->library('form_validation');

			//$this->form_validation->set_rules('photograph', 'photograph', 'required');
			//$this->form_validation->set_rules('signature', 'signature', 'required');
			//$this->form_validation->run();
			if (!empty($_FILES['photograph']['name']) || !empty($_FILES['signature']['name'])){
			   $this->users->insert_update_photo_signature();
			   $this->session->set_flashdata('success', 'Data saved Successfully');
				redirect( base_url('dashboard/details'));
			}
			redirect( base_url('dashboard/details'));
			
		}
		if($user_id != 0) {	
			$data['photo_signature']  = $this->users->get_photo_signature($user_id);   
		}
	  loadLayout('user/photo_signature', $data);
	}

	public function details()
	{
	  $data = null;
	  $user_id = $_SESSION['USER']['user_id'];	  
	   if($user_id != 0) {	
			$data['user_details']  = $this->users->get_user_details($user_id);
			
			$data['post_detail']  = $this->users->get_candidate($user_id); 
			$data['basic_info']  = $this->users->get_basicInfo($user_id);  
			$data['degree_diploma']  = $this->users->get_user_degree_diploma($user_id);
			$data['work_experience']  = $this->users->get_user_work_experience($user_id);
			$data['get_job_list']  = $this->jobpost->get_list();
			
			//pr($data['user_qual']);die;
			   
		}
		
		
		
		
	  if($this->input->post('validate')) {
		  
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
			if(empty($_FILES['photograph']['name'])&&empty($this->input->post('old_photo'))) {
				$this->form_validation->set_rules('photograph', 'Photograph', 'required');
			}
			if(empty($_FILES['signature']['name'])&&empty($this->input->post('old_sign'))) {
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
					if(empty($person_disability)){
						unset($post_val['person_disability']);
					}
					if(empty($photograph)){
						unset($post_val['photograph']);
					}
					if(empty($signature)){
						unset($post_val['signature']);
					}
					if(isset($data['user_details']->id)&&!empty($data['user_details']->id)){
							$user_detail_id=$data['user_details']->id;
							$this->users->update_user_details($user_id,$post_val);
					}else{
						$this->users->insert_update_user_details($post_val);
							
						}
			redirect( base_url('dashboard/preview'));
			
		}
		 if($user_id != 0) {	
			$data['user_details']  = $this->users->get_user_details($user_id);
			
			$data['post_detail']  = $this->users->get_candidate($user_id); 
			$data['basic_info']  = $this->users->get_basicInfo($user_id);  
			$data['degree_diploma']  = $this->users->get_user_degree_diploma($user_id);
			$data['work_experience']  = $this->users->get_user_work_experience($user_id);
			$data['get_job_list']  = $this->jobpost->get_list();
			
			//pr($data['user_qual']);die;
			   
		}
       loadLayout('user/details', $data);

    }

	public function preview()
	{
	  $data = null;
	  $user_id = $_SESSION['USER']['user_id'];
	  $post_val['agree'] = $this->input->post('agree');
	  if($this->input->post()) {
				$this->form_validation->set_rules('agree', 'Agree', 'required');
			}
			
		if($this->form_validation->run() != FALSE){
			$this->users->update_user_details($user_id,$post_val);
			redirect( base_url('dashboard/preview'));
		}
	  $data['user_details']  = $this->users->get_user_details($user_id);
		$data['basic_info']  = $this->users->get_basicInfo($user_id);   
			$data['degree_diploma']  = $this->users->get_user_degree_diploma($user_id);
			$data['work_experience']  = $this->users->get_user_work_experience($user_id);
			$data['get_job_list']  = $this->jobpost->get_list();
		$data['post_detail']  = $this->users->get_candidate($user_id); 
			
	  loadLayout('home/preview', $data);

	}



}    
