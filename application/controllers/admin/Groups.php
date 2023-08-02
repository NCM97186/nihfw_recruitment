<?php
class Groups extends CI_Controller
{

  function __construct() {
    parent::__construct();
    $this->load->model('Groups_model');
    }

    public function index()
    {
      if(!has_admin_permission('GROUPS')) { return; }  
      $data = array();
     $result = $this->Groups_model->get_list();
      $data['ddata']=$result;   
      loadLayout('admin/manage_groups/manage_groups', $data, 'admin');
    }

    public function edit($category_id = 0)
    { 
      if(!has_admin_permission_layout('GROUPS')) { return; }  
  
      $data = array();    
      if($category_id != 0) { 
        $result =  $this->Groups_model->get_group($category_id); 
        if(!$result) { die("Invalid Data");}        
        $data['ddata']= $result;
      }
      //  print_r($data);die;
      loadLayout('admin/manage_groups/edit_groups', $data, 'admin');
    }
    public function update($category_id = 0) 
    {
      if(!has_admin_permission_layout('GROUPS')) { return; }  
      $this->load->library('form_validation');
      $this->form_validation->set_rules('group_name', 'group Name', 'required');
  
      if($this->form_validation->run() == FALSE)
      {
        
        $data = array();
        loadLayout('admin/manage_groups/edit_groups', $data, 'admin');
      }
      else
      {
        $data = array(
          'status' => 1,
          'name' => $this->input->post('group_name')
          );
          
        $this->Groups_model->insert_update($data, $category_id);
      
        $this->session->set_flashdata('success', 'Data saved Successfully');
        $this->load->helper('common');
        $audit_data = array('user_login_id' => 1,
                          'page_id'           => 3,
                          'page_name'         => "Add/Edit Groups",
                          'page_action'       => "Add/Edit",
                          'page_category'     => "Add/Edit",
                          'lang'      		=> "Eng",
                          'page_title'        => 'Add/Edit Groups',
                          'approve_status'    => "1",
                          'usertype'          => "admin"
                      );
      audit_trail($audit_data);
  
        redirect('admin/Groups');    
      
    }
    }


    public function delete($category_id)
    { 
        if(!has_admin_permission_layout('GROUPS')) { return; }  
        if( $this->Groups_model->delete_record($category_id)){
          $this->session->set_flashdata('success', 'Deleted Sucessfully');
          $this->load->helper('common');
           $audit_data = array('user_login_id' => 1,
                            'page_id'           => 3,
                            'page_name'         => "Delete group",
                            'page_action'       => "Delete",
                            'page_category'     => "Delete",
                            'lang'      		=> "Eng",
                            'page_title'        => 'Delete group',
                            'approve_status'    => "1",
                            'usertype'          => "admin"
                        );
          audit_trail($audit_data);
          redirect('admin/Groups');		
        }
    }


}    