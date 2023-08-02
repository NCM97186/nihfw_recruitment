<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
	    parent::__construct();
	    $this->admin_info      =  $this->common->__check_session();
	    $this->load->model('User_model');
	    $this->load->model('Department_model');
		$this->load->model('Designation_model');	
		$this->load->library("pagination");

	}

	
	public function index(){
	 
		$queryWhere    = array();	
		
		$role_id   = $this->input->get('role_id', TRUE);
		$designation_id   = $this->input->get('designation_id', TRUE);
		$department_id   = $this->input->get('department_id', TRUE);
		$username   = $this->input->get('username', TRUE);
		
	     if (intval($role_id) != 0) {
	            $queryWhere[] = " tbl_admin_login.role_id= '".addslashes($role_id)."'";
	    }
	    if (intval($designation_id) != 0) {
	            $queryWhere[] = " m_designation.designation_id= '".addslashes($designation_id)."'";
	    }
		 if (intval($department_id) != 0) {
	            $queryWhere[] = " m_department.department_id= '".addslashes($department_id)."'";
	    }
		if (!count($queryWhere) > 0) {
	            $queryWhere[] =" tbl_admin_login.username LIKE '%".$username."%'";
	        }	

		$filterArray['WHERE'] = $queryWhere;
		//$data['user_list']  = $this->User_model->getUserlist($filterArray);
		$data['roles'] = $this->User_model->getRoleList();

		$per_page = 40;
		$offset = ($this->input->get('page')) ? ( ( $this->input->get('page') - 1 ) * $per_page ) : 0;
		$data['per_page']=$per_page;
		$data['offset']=$offset;
		$data['user_list']  = $this->User_model->getUserlist($filterArray,$per_page, $offset);
		$total_rows = $this->User_model->get_last_calculated_total();
		$data['pg']=ceil($total_rows/$per_page);
		$data['total_rows']=$total_rows;
	    $data["links"] = my_pagination($total_rows,$per_page,"admin/user/");

		$data['role_id'] = $role_id;
		$data['designation_id'] = $designation_id;
		$data['department_id'] = $department_id;
		
		loadLayout('admin/user_mgt/list_user', $data, 'admin');
	
	}
    /** get a single User detail */
	public function getUserDetail($uId){ 
	
	    $data = $this->User_model->getUser($uId);
		if(!empty($data)) {
		 $this->load->view('admin/user_mgt/view_user', $data);
		 return;
		}
		echo '<h3 class="text-danger">Record not found!</h3>';
		
	}
    
	public function add_edit_user($admin_id = 0){
		$this->load->helper('common');
	
	    $data['admin_id'] = intval($admin_id);
		
	    if(isset($_POST) && count($_POST) > 0) {
			$data =  $this->input->post(NULL); // get all post data		
	    }
		
		
		if($data['admin_id'] == 0 ) {
			// check user permission for add user
			if(!has_admin_permission_layout('ADD_USER',$this->input->post_get('layout_type'))) { return; }		
			$data['form_title'] = 'Add User';
		}
		else {
			// Edit user is in popup
			if(!has_admin_permission_layout('EDIT_USER',$this->input->post_get('layout_type'))) { return; }
			
			$userDetail =  $this->User_model->getUser($data['admin_id']);
			if(empty($userDetail)) {
				echo '<h3 class="text-danger">Record not found!</h3>';
				return;
			}
			$data = array_merge($data, $userDetail);
			$data['form_title'] = 'Edit User';
			
		}
		$data['form_url'] = base_url('admin/user/add_edit_user');
		$data['roles']  = $this->User_model->getRoleList();
		$data['departments']  = $this->Department_model->get_list();
		$data['designations']  = $this->Designation_model->get_list();
		//$this->load->view('admin/user_mgt/add_edit_user', $data, $this->input->post_get('popup'));		
		$this->save_user($data);
		
	}


	
	private function save_user($data){
	
	    if($data['admin_id'] == 0  || ($data['admin_id'] != 0 && $data['username'] != $this->input->post('username')))  {
		
			$this->form_validation->set_rules('username', 'User Name', 'required|is_unique[tbl_admin_login.username]'); 
		}
		if($data['admin_id'] == 0  || ($data['admin_id'] != 0 && $data['mobile'] != $this->input->post('mobile'))) {
			 
			$this->form_validation->set_rules('mobile', 'Mobile', 'max_length[10]|min_length[10]|xss_clean|is_unique[tbl_admin_login.mobile]');
			
		}
		
		if($data['admin_id'] == 0  || ($data['admin_id'] != 0 && $data['email'] != $this->input->post('email'))) {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|is_unique[tbl_admin_login.email]');
		}
		
	    if($data['admin_id'] == 0  || ($data['admin_id'] != 0 && $this->input->post('password')  != '' ) ) {
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
		}
		
		$this->form_validation->set_rules('fname', 'Full Name', 'required');
		$this->form_validation->set_rules('department_id', 'Department Name', 'required');
		$this->form_validation->set_rules('designation_id', 'Designation Name', 'required');
		$this->form_validation->set_rules('role_id', 'Role', 'required');

		
		$data['layout_type'] =  $this->input->post_get('layout_type')?  $this->input->post_get('layout_type') : 'admin';
		
		
		if ($this->form_validation->run() == FALSE) {
			
			loadLayout('admin/user_mgt/add_edit_user', $data,  $data['layout_type']);
			return;
	  	}else {


	        /* Server Side Script */
		
			$params_data = array(
					'fname'    => $this->input->post('fname'),
					'mobile'  => $this->input->post('mobile'),
					'password' => $this->input->post('password'),
					'username' => $this->input->post('username'),
					'role_id' 	   => $this->input->post('role_id'),					
					'email'    => $this->input->post('email'),
					'department_id'    => $this->input->post('department_id'),
					'designation_id'    => $this->input->post('designation_id'),
					'status'   => intval($this->input->post('status'))
			);
			// print_r($params_data);
			// die();

			if( $data['admin_id'] != 0 ) {
			
				if($this->input->post('password')  == '') {
					unset($params_data['password']); // in case user don't want to change password 
				}
				$is_error = $this->User_model->update_user($params_data,$data['admin_id'] );
				
			}else {
				$is_error = $this->User_model->insert_user($params_data);
				$data['admin_id'] = $this->db->insert_id();
                $audit_data = array('user_login_id' => 1,
						'page_id'           => 10,
						'page_name'         => "Add user",
						'page_action'       => "edit",
						'page_category'     => "edit",
						'lang'      		=> "Eng",
						'page_title'        => 'edit user',
						'approve_status'    => "1",
						'usertype'          => "admin"
					);
		      audit_trail($audit_data);

			}
			

			if(!$is_error) {
				$this->session->set_flashdata('error', 'Data could not Saved!.');			
				loadLayout('admin/user_mgt/add_edit_user', $data, $data['layout_type']);
				
			}else {		
				$this->session->set_flashdata('success', 'User Data Saved Successfully!!.');
				$audit_data = array('user_login_id' => 1,
						'page_id'           => 10,
						'page_name'         => "edit user",
						'page_action'       => "edit",
						'page_category'     => "edit",
						'lang'      		=> "Eng",
						'page_title'        => 'edit user',
						'approve_status'    => "1",
						'usertype'          => "admin"
					);
		      audit_trail($audit_data);
				
				if( $data['layout_type'] == 'popup') {	
					$userDetail =  $this->User_model->getUser($data['admin_id']);
					if(empty($userDetail)) {
						echo '<h3 class="text-danger">Record not found!</h3>';
						return;
					}
					$data = array_merge($data, $userDetail);				
					loadLayout('admin/user_mgt/add_edit_user', $data, $data['layout_type']);
				}else {
					redirect('admin/User/index');
				}
			}

	     }
	
	}
	
	public function unique_user_name(){

	    $username = $this->input->post('username');
	    $check = $this->db->get_where('tbl_admin_login', array('username' => $username), 1);
				if ($check->num_rows() > 0) 
				{
	        $this->form_validation->set_message('username', 'This name already exists in our database');
	        return FALSE;
	    }
	    return TRUE;
	}



	public function update_status(){

		$status = $this->input->post('status');
		$id 	= $this->input->post('id');
		$this->User_model->update_user_status($id, $status);

	}

	/*
	public function deleteUser(){

	$this->db->delete('tbl_admin_login', array('admin_id' =>$this->input->post('did')));
	echo $this->session->set_flashdata('success','Record Deleted Successfully');
	redirect('view_user');
	}
	*/
	public function roles(){
	
		// check user permission
		if(!has_admin_permission_layout('VIEW_ROLES')) { return; }
		
		$data['page_title'] = 'User Roles';	
	 	$data['roles'] = $this->User_model->getRoleList();
		loadLayout('admin/user_mgt/view_roles', $data, 'admin'); 
	}



	public function roles_permission($role_id){ 
		// check user permission
		if(!has_admin_permission_layout('EDIT_ROLE_PERMISSIONS')) { return; }
		$data['page_title'] = 'User Role Permissions';	
		$data['role_id'] = $role_id;
		$data['roles_permission'] = $this->User_model->getRolePermission($role_id);
		$data['role_detail'] = $this->User_model->getRole($role_id); 
		loadLayout('admin/user_mgt/role_permissions', $data, 'admin'); 
	}
          
	public function roles_permission_save(){ 

	    $role_id = $this->input->post_get('role_id');
		$data['role_id'] = $role_id;

		if($this->User_model->saveRolePermissions($role_id)) {	

	       $this->session->set_flashdata('success', 'User Data Saved Successfully!!.');
	       redirect('admin/user/roles_permission/'.$role_id);
	    }else {
  		     $this->session->set_flashdata('error', 'User Data not Saved Successfully!!.');
  		     redirect('admin/user/roles_permission/'.$role_id);
	    }
	    
        //redirect( $_SERVER['HTTP_REFERER']);	
	}

	

}
