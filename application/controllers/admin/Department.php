<?php

class Department extends CI_Controller
{

  function __construct() {
    parent::__construct();
    $this->load->model('Department_model');
    }

  public function index()
  {
    if(!has_admin_permission_layout('SETTING_DEPARTMENT')) { return; }  
    $data = array();
    $result = $this->Department_model->get_list();
    $data['ddata']=$result;   
    loadLayout('admin/department/department', $data, 'admin');
  }

  public function edit($department_id = 0)
  { 
    if(!has_admin_permission_layout('SETTING_DEPARTMENT')) { return; }  

    $data = array();    
    if($department_id != 0) { 
      $result =  $this->Department_model->get_department($department_id); 
      if(!$result) { die("Invalid Data");}        
      $data['ddata']= $result;
    }
    //  print_r($data);die;
    loadLayout('admin/department/departmentEdit', $data, 'admin');
  }

  public function update($department_id = 0) 
  {
    if(!has_admin_permission_layout('SETTING_DEPARTMENT')) { return; }  
    $this->load->library('form_validation');
    $this->form_validation->set_rules('department_name', 'Department Name', 'required');

    if($this->form_validation->run() == FALSE)
    {
      
      $data = array();
      loadLayout('admin/department/departmentEdit', $data, 'admin');
    }
    else
    {
      $data = array(
        'department_status' => 1,
        'department_name' => $this->input->post('department_name')
        );
        
      $this->Department_model->insert_update($data, $department_id);
    
      $this->session->set_flashdata('success', 'Data saved Successfully');
	  $this->load->helper('common');
	  $audit_data = array('user_login_id' => 1,
						'page_id'           => 3,
						'page_name'         => "Add/Edit Department",
						'page_action'       => "Add/Edit",
						'page_category'     => "Add/Edit",
						'lang'      		=> "Eng",
						'page_title'        => 'Add/Edit user',
						'approve_status'    => "1",
						'usertype'          => "admin"
					);
	audit_trail($audit_data);

      redirect('admin/department');    
    
    }
  }

  public function delete($department_id)
  { 
    if(!has_admin_permission_layout('SETTING_DEPARTMENT')) { return; }  
    if( $this->Department_model->delete_record($department_id)){
      $this->session->set_flashdata('success', 'Deleted Sucessfully');
      $this->load->helper('common');
   	$audit_data = array('user_login_id' => 1,
						'page_id'           => 3,
						'page_name'         => "Delete Department",
						'page_action'       => "Delete",
						'page_category'     => "Delete",
						'lang'      		=> "Eng",
						'page_title'        => 'Delete user',
						'approve_status'    => "1",
						'usertype'          => "admin"
					);
	  audit_trail($audit_data);
      redirect('admin/department');		
    }
  }

}