<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('loginmodel','',TRUE);
		$this->load->model('Users_model','users');
		$this->load->model('Participants_model');
		$this->load->model('Advertisement_model');
		$this->load->model('JobPost_model');
		$this->load->model('Category_model');
		$this->load->helper('common_helper','common',TRUE);
        $this->admin_info     =  $this->common->__check_session();
		// check_cookies();
    }
	
	public function index()
	{
		// setup filter
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
		
		$data = [];
		$applicants = $this->Participants_model->get_filteredlist($advertise,$postid,$gender_id,$category_id,$status_id,$fromdate, $todate,$export);
        $fee_paid= 0;
		$rejected= 0;
		$shortlisted= 0;
		$pending= 0;
		$draft= 0;

		for ($i=0; $i < count($applicants); $i++) { 

			if($applicants[$i]->status_id == 1){
              $fee_paid = $fee_paid +1;
			}
			if($applicants[$i]->status_id == 4){
				$rejected = $rejected +1;
			  }
			  if($applicants[$i]->status_id == 5){
				$pending = $pending +1;
			  }
			  if($applicants[$i]->status_id == 2){
				$shortlisted = $shortlisted +1;
			  }
			  if($applicants[$i]->status_id == 6){
				$draft = $draft +1;
			  }
		
		}
		$data['shortlisted'] = $shortlisted;
		$data['pending'] = $pending;
		$data['fee_paid'] = $fee_paid;
		$data['rejected'] = $rejected;
		$data['draft'] = $draft;
		
		$data['total_applicant'] = count($applicants);
		$data['applicant_list'] = $applicants;
		$data['advertisement'] = $this->Advertisement_model->get_list();
		$data['jobpost'] = $this->JobPost_model->get_list(); 
		$data['category'] = $this->Category_model->get_list();

		
    	$query=$this->db->get('cand_profile_status_master');
    	$data['candprofilestatus']=$query->result();

	// print_r($data['total_applicant']);
	// die();
	  //$data = null;
	  loadLayout('admin/dashboard', $data,'admin');

	}
	public function exportcsv(){ 
		//csv file name
		$filename = 'users_'.date('Ymd').'.csv';
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
		$applicants = $this->Participants_model->get_filteredlist($advertise,$postid,$gender_id,$category_id,$status_id,$fromdate, $todate,$export);
  
		// file creation
		$file = fopen('php://output', 'w');
        $header =     array ( "application_id", "name", "benchmark", "department", "category_name", "category_attachment", "person_disability", "add_disablity", "dob", "dob_doc", "gender", "marital_status", "father_name", "mother_name", "identity_proof", "adhar_card_number", "adhar_card_doc", "corr_address", "corr_state", "corr_pincode", "perm_address", "perm_state", "perm_pincode", "photograph", "signature", "deg", "year", "sub", "uni", "div", "per", "file_path", "to_date", "organization", "post_held", "pay_scale", "from_date", "post_name", "adver_no", "adver_title");
		fputcsv($file, $header);
        $category_attachment= base_url("uploads/category_attachment/");
		$adhar_card_doc=base_url("uploads/adhar_card_doc/");
		$person_disability=base_url("uploads/person_disability/");
		$photograph=base_url("uploads/photograph/");
		$signature=base_url("uploads/signature/");
		$dob_proof=base_url("uploads/dob_proof/");
		$education_proof=base_url("uploads/education_proof/");
		$organization_file=base_url("uploads/organization_file/");

		foreach ($applicants as $line){
			
		   fputcsv($file, [
				$line->application_id,
				$line->name,
				$line->benchmark,
				$line->department,
				$line->category_name,
				$category_attachment.'/'.$line->category_attachment,
				$line->department,
				$line->department,
				$line->department,
				$line->department,
				$line->department,
		   ]);
		}

		fclose($file);
		exit;
	}
	public function change_pass()
	{
		loadLayout('admin/change_password','','admin');
		
	}
	public function changePasswordProcess()
	{
		
		$data  = array();
		
		$_POST = $this->security->xss_clean($this->input->post());
		

		foreach($_POST as $postKey => $postValue)
		{
			$_POST[$postKey] 	= $postValue;
			$data[$postKey] 	= $postValue;
		}

		//validation
		$this->load->library('form_validation');
                $this->form_validation->set_rules('old_password', 'Username', 'trim|required');
                $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
                $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				$this->load->view('admin/Dashboard/change_pass',$data);
		}
		else
		{
                    
                    $where  = array('admin_id'=> $_SESSION['ADMIN']['admin_id']);
				
                    $list   = $this->loginmodel->view_single($where);
					
					$postoldpass = $_POST['old_password'];
					$newpwd    = strtoupper($list['password']);
				// echo $postoldpass;
				// echo "<br>";
				// echo $newpwd;
				// die();
                    if(count($list)){
						
						if($newpwd != $postoldpass)
						{ 
							//error old password is not matched
							$this->session->set_flashdata('error', '<span style="color:white;">Wrong old password.</span>');
							redirect(site_url('admin/Dashboard/change_pass'));
						}
						if($_POST['new_password'] != $_POST['confirm_password'])
						{
							//error confirm password is not matched with new password
							$this->session->set_flashdata('error', '<span style="color:white;">Confirm password not match.</span>');
							redirect(site_url('admin/Dashboard/change_pass'));
						}

						if($_POST['new_password']==''){
							unset($_POST['new_password']);
						}
                        $wherehistory = array("id" => $_SESSION['ADMIN']['admin_id'], "user_pass" => $_POST['new_password']);
                        $historyresult = $this->loginmodel->pwdhistory($wherehistory);
						if($historyresult){
							$this->session->set_flashdata('error', '<span style="color:white;">Password already Used.</span>');
							redirect(site_url('admin/Dashboard/change_pass'));
						}else{
						$dataArr = array(); 
						$dataArr = $this->input->post();  
						$pArray = array();
						$pArray['password']   = $_POST['new_password'];
						$result 	= $this->loginmodel->save($list['admin_id'],$pArray);
						$pwdhistory = array("id" => $_SESSION['ADMIN']['admin_id'], "user_pass" => $_POST['new_password']);
						$history	= $this->loginmodel->save_history($pwdhistory);
						}
						
					}else{
						$this->session->set_flashdata('error', '<span style="color:white;">Invalid details.</span>');
						redirect(site_url('admin/Dashboard/change_pass'));
					}
					
			if($result > 0)
			{
				$this->session->set_flashdata('success', '<span style="color:green;">Password changed.</span>');
				redirect(site_url('Logout'));
			} 
			else 
			{
				$this->session->set_flashdata('error', '<span style="color:white;">Password Does not changed.</span>');
				redirect(site_url('admin/Dashboard/change_pass'));
			}

		}
	}

}
