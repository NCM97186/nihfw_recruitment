<?php
class Agerelaxation extends CI_Controller
{

  function __construct() {
    parent::__construct();
    $this->load->model('Age_category_model', 'Age_Model', TRUE);
    $this->load->model('Category_model');
    }



    public function index()
    {
      if(!has_admin_permission('AGE_RELAXATION')) { return; }  
      $data = array();
      $result = $this->Age_Model->get_age_list();
      $data['ddata']=$result;   
      loadLayout('admin/age_relaxation/manage_relaxation', $data, 'admin');
    }

    public function edit($id = 0)
    { 
      if(!has_admin_permission_layout('AGE_RELAXATION')) { return; }  
  
      $data = array();    
      if($id != 0) { 
        $result =  $this->Age_Model->get_age_data($id); 
        if(!$result) { die("Invalid Data");}  
        $data['ddata']= $result;
      }
      $data['category'] = $this->Category_model->get_list();
    
      loadLayout('admin/age_relaxation/relaxation_edit', $data, 'admin');
    }
  public function update($id = 0) 
  {
      if(!has_admin_permission_layout('AGE_RELAXATION')) { return; }  
      $this->load->library('form_validation');
      $this->form_validation->set_rules('category_id', 'Category Name', 'required');
      $this->form_validation->set_rules('Person_disablity', 'Person disablity', 'required');
      $this->form_validation->set_rules('relaxation', 'Age relaxation', 'required');  
      // $this->form_validation->set_rules('ex_serviceman_category', 'Ex-Service Man Category', 'required');
      if($this->form_validation->run() == FALSE)
      {
       
        $data = array();
        $data['category'] = $this->Category_model->get_list();
        loadLayout('admin/age_relaxation/relaxation_edit', $data, 'admin');
      }
      else
      {
        if($this->input->post('category_id') !=7 ){
          $ex_serviceman_category = 'NO';
        }else{
          $ex_serviceman_category = $this->input->post('ex_serviceman_category');
        }
        $data = array(
          'status' => 1,
          'catid' => $this->input->post('category_id'),
          'relaxation' => $this->input->post('relaxation'),
          'Person_disablity' => $this->input->post('Person_disablity'),
          'ex_serviceman_category' => $ex_serviceman_category

          );
          
        $this->Age_Model->insert_update_agedata($data, $id);
      
        $this->session->set_flashdata('success', 'Data saved Successfully');
        $this->load->helper('common');
        $audit_data = array('user_login_id' => 1,
                          'page_id'           => 3,
                          'page_name'         => "Add/Edit Age Relaxation",
                          'page_action'       => "Add/Edit",
                          'page_category'     => "Add/Edit",
                          'lang'      		=> "Eng",
                          'page_title'        => 'Add/Edit  Age Relaxation',
                          'approve_status'    => "1",
                          'usertype'          => "admin"
                      );
      audit_trail($audit_data);
  
        redirect('admin/Agerelaxation');    
      
    }
    }
    public function delete($id)
    { 
        if(!has_admin_permission_layout('AGE_RELAXATION')) { return; }  
        if( $this->Age_Model->delete_agedata_record($id)){
          $this->session->set_flashdata('success', 'Deleted Sucessfully');
          $this->load->helper('common');
           $audit_data = array('user_login_id' => 1,
                            'page_id'           => 3,
                            'page_name'         => "Delete Age relaxation",
                            'page_action'       => "Delete",
                            'page_category'     => "Delete",
                            'lang'      		=> "Eng",
                            'page_title'        => 'Delete Age relaxation',
                            'approve_status'    => "1",
                            'usertype'          => "admin"
                        );
          audit_trail($audit_data);
          redirect('admin/Agerelaxation');		
        }
    }
   


}