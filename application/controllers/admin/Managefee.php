<?php
class Managefee extends CI_Controller
{

  function __construct() {
    parent::__construct();
    $this->load->model('Fee_model');
    $this->load->model('Category_model');
    $this->load->model('Groups_model');
    }
    public function index()
    {
      if(!has_admin_permission('MANAGE_FEE')) { return; }  
      $data = array();
      $result = $this->Fee_model->get_fee_list();
      $data['ddata']=$result;   
      loadLayout('admin/managefee/managefee', $data, 'admin');
    }

    public function edit($id = 0)
    { 
      if(!has_admin_permission_layout('MANAGE_FEE')) { return; }  
  
      $data = array();    
      if($id != 0) { 
        $result =  $this->Fee_model->get_fee($id);
        if(!$result) { die("Invalid Data");}  
        $data['ddata']= $result;
      }
     
      $data['category'] = $this->Category_model->get_list();
      $data['group'] = $this->Groups_model->get_list();
      loadLayout('admin/managefee/fee_edit', $data, 'admin');
    }
    public function update($id = 0) 
    {
        
        if(!has_admin_permission_layout('MANAGE_FEE')) { return; }  
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category_id', 'Category Name', 'required');
        $this->form_validation->set_rules('group_id', 'Groups', 'required');
        $this->form_validation->set_rules('category_type', 'category type', 'required');
        $this->form_validation->set_rules('fee', 'manage fee', 'required');  
        if($this->form_validation->run() == FALSE)
        {
          
          $data = array();
          $data['category'] = $this->Category_model->get_list();
          $data['group'] = $this->Groups_model->get_list();
          loadLayout('admin/managefee/fee_edit', $data, 'admin');
        }
        else
        {
          $data = array(
            'status' => 1,
            'cat_id' => $this->input->post('category_id'),
            'fee' => $this->input->post('fee'),
            'category_type' => $this->input->post('category_type'),
            'group_id' => $this->input->post('group_id')
              );
            
          $this->Fee_model->insert_update_feedata($data, $id);
          $this->session->set_flashdata('success', 'Data saved Successfully');
          $this->load->helper('common');
          $audit_data = array('user_login_id' => 1,
                            'page_id'           => 3,
                            'page_name'         => "Add/Edit Fee",
                            'page_action'       => "Add/Edit",
                            'page_category'     => "Add/Edit",
                            'lang'      		=> "Eng",
                            'page_title'        => 'Add/Edit  Fee',
                            'approve_status'    => "1",
                            'usertype'          => "admin"
                        );
        audit_trail($audit_data);
    
          redirect('admin/Managefee');    
        
      }
    }
    public function delete($id)
    { 
        if(!has_admin_permission_layout('MANAGE_FEE')) { return; }  
        if( $this->Fee_model->delete_fee_record($id)){
          $this->session->set_flashdata('success', 'Deleted Sucessfully');
          $this->load->helper('common');
           $audit_data = array('user_login_id' => 1,
                            'page_id'           => 3,
                            'page_name'         => "Delete fee",
                            'page_action'       => "Delete",
                            'page_category'     => "Delete",
                            'lang'      		=> "Eng",
                            'page_title'        => 'Delete fee',
                            'approve_status'    => "1",
                            'usertype'          => "admin"
                        );
          audit_trail($audit_data);
          redirect('admin/Managefee');		
        }
    }


}
