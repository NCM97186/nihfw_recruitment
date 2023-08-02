<?php
class Subcategory extends CI_Controller
{

  function __construct() {
    parent::__construct();
    $this->load->model('Category_model');
    }

    public function index()
    {
      if(!has_admin_permission('SUBCATEGORY')) { return; }  
      $data = array();
      $result = $this->Category_model->get_subcategory_list();
      $data['ddata']=$result;   
      loadLayout('admin/subcategory/subcategory', $data, 'admin');
    }

    public function edit($subcategory_id = 0)
    { 
      if(!has_admin_permission_layout('SUBCATEGORY')) { return; }  
  
      $data = array();    
      if($subcategory_id != 0) { 
        $result =  $this->Category_model->get_subcategory($subcategory_id); 
        if(!$result) { die("Invalid Data");}  
        $data['ddata']= $result;
      }
      $data['category'] = $this->Category_model->get_list();
      loadLayout('admin/subcategory/subcategory_edit', $data, 'admin');
    }

    public function update($subcategory_id = 0) 
    {
      if(!has_admin_permission_layout('SUBCATEGORY')) { return; }  
      $this->load->library('form_validation');
      $this->form_validation->set_rules('category_id', 'Category Name', 'required');
      $this->form_validation->set_rules('subcategory', 'Subcategory Name', 'required');  
      if($this->form_validation->run() == FALSE)
      {
        
        $data = array();
        loadLayout('admin/Subcategory/edit', $data, 'admin');
      }
      else
      {
        $data = array(
          'status' => 1,
          'category_id' => $this->input->post('category_id'),
          'subcategory' => $this->input->post('subcategory')
          );
          
        $this->Category_model->insert_update_subcategory($data, $subcategory_id);
      
        $this->session->set_flashdata('success', 'Data saved Successfully');
        $this->load->helper('common');
        $audit_data = array('user_login_id' => 1,
                          'page_id'           => 3,
                          'page_name'         => "Add/Edit Subcategory",
                          'page_action'       => "Add/Edit",
                          'page_category'     => "Add/Edit",
                          'lang'      		=> "Eng",
                          'page_title'        => 'Add/Edit user',
                          'approve_status'    => "1",
                          'usertype'          => "admin"
                      );
      audit_trail($audit_data);
  
        redirect('admin/Subcategory');    
      
    }
    }

    public function delete($subcategory_id)
    { 
        if(!has_admin_permission_layout('SUBCATEGORY')) { return; }  
        if( $this->Category_model->delete_subcategory_record($subcategory_id)){
          $this->session->set_flashdata('success', 'Deleted Sucessfully');
          $this->load->helper('common');
           $audit_data = array('user_login_id' => 1,
                            'page_id'           => 3,
                            'page_name'         => "Delete Subcategory",
                            'page_action'       => "Delete",
                            'page_category'     => "Delete",
                            'lang'      		=> "Eng",
                            'page_title'        => 'Delete Subcategory',
                            'approve_status'    => "1",
                            'usertype'          => "admin"
                        );
          audit_trail($audit_data);
          redirect('admin/Subcategory');		
        }
    }
}