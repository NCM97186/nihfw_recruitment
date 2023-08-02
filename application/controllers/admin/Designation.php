<?php

class Designation extends CI_Controller
{

  function __construct() {
		parent::__construct();
		$this->load->model('Designation_model');
   }

  public function index()
  {
    if(!has_admin_permission_layout('SETTING_DESIGNATION')) { return; }  
    $data = array();
    $result = $this->Designation_model->get_list();
    $data['dsdata']=$result;   
    loadLayout('admin/designation/designation', $data, 'admin');
  }

  public function edit($designation_id = 0)
  {    
    if(!has_admin_permission_layout('SETTING_DESIGNATION')) { return; }  

    $data = array();    
    if($designation_id != 0) { 
      $result =  $this->Designation_model->get_designation($designation_id); 
      if(!$result) { die("Invalid Data");}        
      $data['dsdata']= $result;
    }
    loadLayout('admin/designation/designationEdit', $data, 'admin');
  }

  public function update($designation_id = 0) 
  {
    if(!has_admin_permission_layout('SETTING_DESIGNATION')) { return; }  
    $this->load->library('form_validation');
    $this->form_validation->set_rules('designation_name', 'Designation Name', 'required');

    if($this->form_validation->run() == FALSE)
    {
      
      $data = array();
      $this->session->set_flashdata('msgerr', 'Oops Error occured!');
      loadLayout('admin/designation/designationEdit', $data, 'admin');
    }
    else
    {
      $data = array(
        'designation_status' => 1,
        'designation_name' => $this->input->post('designation_name')
        );
        
      $this->Designation_model->insert_update($data, $designation_id);
    
      $this->session->set_flashdata('success', 'Data saved Successfully');
	  $this->load->helper('common');
	  $audit_data = array('user_login_id' => 1,
						'page_id'           => 3,
						'page_name'         => "Add/Edit Designation",
						'page_action'       => "Add/Edit",
						'page_category'     => "Add/Edit",
						'lang'      		=> "Eng",
						'page_title'        => 'Add/Edit user',
						'approve_status'    => "1",
						'usertype'          => "admin"
					);
	audit_trail($audit_data);

      redirect('admin/designation');    
    
    }
  }

  public function delete($designation_id)
  { 
    if(!has_admin_permission_layout('SETTING_DESIGNATION')) { return; }  
    if( $this->Designation_model->delete_record($designation_id)){
      $this->session->set_flashdata('success', 'Deleted Sucessfully');
	  $this->load->helper('common');
	  $audit_data = array('user_login_id' => 1,
						'page_id'           => 3,
						'page_name'         => "Delete Designation",
						'page_action'       => "Delete",
						'page_category'     => "Delete",
						'lang'      		=> "Eng",
						'page_title'        => 'Delete user',
						'approve_status'    => "1",
						'usertype'          => "admin"
					);
	  audit_trail($audit_data);
      redirect('admin/designation');		
    }
  }

}