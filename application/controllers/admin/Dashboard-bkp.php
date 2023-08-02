<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('loginmodel','',TRUE);
		$this->load->helper('common_helper','common',TRUE);
        $this->admin_info     =  $this->common->__check_session();

    }
	
	public function index()
	{
	  $data = null;
	  loadLayout('admin/dashboard', $data,'admin');

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
					
					$postoldpass = hash("sha512", $_POST['old_password']);
					$newpwd    = $list['password'];
				
					
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
							$this->session->set_flashdata('error', '<span style="color:white;">Confirm new password not match.</span>');
							redirect(site_url('admin/Dashboard/change_pass'));
						}

						if($_POST['new_password']==''){
							unset($_POST['new_password']);
						}
                        $wherehistory = array("id" => $_SESSION['ADMIN']['admin_id'], "user_pass" => hash("sha512", $_POST['new_password']));
                        $historyresult = $this->loginmodel->pwdhistory($wherehistory);
						if($historyresult){
							$this->session->set_flashdata('error', '<span style="color:white;">Password already Used.</span>');
							redirect(site_url('admin/Dashboard/change_pass'));
						}else{
						$dataArr = array(); 
						$dataArr = $this->input->post();  
						$pArray = array();
						$pArray['password']   = hash("sha512", $_POST['new_password']);;
						$result 	= $this->loginmodel->save($list['admin_id'],$pArray);
						$pwdhistory = array("id" => $_SESSION['ADMIN']['admin_id'], "user_pass" => hash("sha512", $_POST['new_password']));
						$history	= $this->loginmodel->save_history($pwdhistory);
						}
						
					}else{
						$this->session->set_flashdata('error', '<span style="color:white;">Invalid details.</span>');
						redirect(site_url('admin/Dashboard/change_pass'));
					}
					
			if($result > 0)
			{
				$this->session->set_flashdata('success', '<span style="color:green;">Password changed.</span>');
				redirect(site_url('admin/Dashboard/change_pass'));
			} 
			else 
			{
				$this->session->set_flashdata('error', '<span style="color:white;">Password Does not changed.</span>');
				redirect(site_url('admin/Dashboard/change_pass'));
			}

		}
	}

}
