<?php
class Category extends CI_Controller
{

  function __construct() {
    parent::__construct();
    $this->load->model('Category_model');
    }
    
    public function index()
    {
      if(!has_admin_permission('CATEGORY')) { return; }  
      $data = array();
     $result = $this->Category_model->get_list();
      $data['ddata']=$result;   
      loadLayout('admin/category/category', $data, 'admin');
    }

    public function edit($category_id = 0)
    { 
      if(!has_admin_permission_layout('CATEGORY')) { return; }  
  
      $data = array();    
      if($category_id != 0) { 
        $result =  $this->Category_model->get_category($category_id); 
        if(!$result) { die("Invalid Data");}        
        $data['ddata']= $result;
      }
      //  print_r($data);die;
      loadLayout('admin/category/category_edit', $data, 'admin');
    }
    public function update($category_id = 0) 
    {
      if(!has_admin_permission_layout('CATEGORY')) { return; }  
      $this->load->library('form_validation');
      $this->form_validation->set_rules('category', 'Category Name', 'required');
  
      if($this->form_validation->run() == FALSE)
      {
        
        $data = array();
       
        loadLayout('admin/category/category_edit', $data, 'admin');
      }
      else
      {
        $data = array(
          'status' => 1,
          'category' => $this->input->post('category')
          );
          
        $this->Category_model->insert_update($data, $category_id);
      
        $this->session->set_flashdata('success', 'Data saved Successfully');
        $this->load->helper('common');
        $audit_data = array('user_login_id' => 1,
                          'page_id'           => 3,
                          'page_name'         => "Add/Edit Category",
                          'page_action'       => "Add/Edit",
                          'page_category'     => "Add/Edit",
                          'lang'      		=> "Eng",
                          'page_title'        => 'Add/Edit user',
                          'approve_status'    => "1",
                          'usertype'          => "admin"
                      );
        audit_trail($audit_data);
        redirect('admin/category');    
      
    }
    }


    public function delete($category_id)
    { 
        if(!has_admin_permission_layout('CATEGORY')) { return; }  
        if( $this->Category_model->delete_record($category_id)){
          $this->session->set_flashdata('success', 'Deleted Sucessfully');
          $this->load->helper('common');
           $audit_data = array('user_login_id' => 1,
                            'page_id'           => 3,
                            'page_name'         => "Delete Category",
                            'page_action'       => "Delete",
                            'page_category'     => "Delete",
                            'lang'      		=> "Eng",
                            'page_title'        => 'Delete category',
                            'approve_status'    => "1",
                            'usertype'          => "admin"
                        );
          audit_trail($audit_data);
          redirect('admin/Category');		
        }
    }



}




