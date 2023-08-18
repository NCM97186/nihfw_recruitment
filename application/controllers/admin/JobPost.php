<?php

class JobPost extends CI_Controller
{

  function __construct() {
    parent::__construct();
	//$this->admin_info     =  $this->common->__check_session();
    $this->load->model('JobPost_model');
    $this->load->model('Groups_model');
    $this->load->model('Category_model');
    $this->load->library('session');
    $this->load->helper('common_helper','common',TRUE);
    $this->admin_info     =  $this->common->__check_session();
    }

  public function index()
  {
    
    if(!has_admin_permission_layout('JOB_POST')) { return; }
    $data = array();
    $result = $this->JobPost_model->get_list(); 
    $data['ddata']=$result;
  //  print_r($data);die;
    loadLayout('admin/jobPost/jobPost', $data, 'admin');
  }

  public function edit($post_id = 0)  
  {
  
    if(!has_admin_permission_layout('JOB_POST')) { return; }

    $data = array();
    if($post_id != 0) { 
      $result =  $this->JobPost_model->get_jobPost($post_id);
      if(!$result) { ("Invalid Data");}
      $data['ddata']= $result;
    } 
    $data['categories'] = $this->Category_model->get_list();
    $data['group'] = $this->Groups_model->get_list();
    loadLayout('admin/jobPost/jobPostEdit', $data, 'admin');
  }

  public function update($post_id = 0) 
  {
    
      
    
 
      
      // $this->db->insert($data,"category_post_quantity");
    //}

    if(!has_admin_permission_layout('JOB_POST')) { return; }
    $this->load->library('form_validation');
    $this->form_validation->set_rules('category[]', 'Atleast One Category Must Select', 'required');
    $this->form_validation->set_rules('adver_id', 'Advertisement', 'required');
    $this->form_validation->set_rules('total_num_jobs', 'No. Of Jobs', 'required');
    $this->form_validation->set_rules('post_name', 'Post Name', 'required');
    $this->form_validation->set_rules('group_id', 'Groups', 'required');
    $this->form_validation->set_rules('start_date', 'Start Date', 'required');
    $this->form_validation->set_rules('last_date', 'Last Date ', 'required');
    $this->form_validation->set_rules('min_age_date', 'Min Age Date ', 'required');
    $this->form_validation->set_rules('max_age_date', 'Max Age Date ', 'required');
    $this->form_validation->set_rules('post_status', 'Status', 'required');

    if($this->form_validation->run() == FALSE)
    {

      $data = array();
      $data['categories'] = $this->Category_model->get_list();
       $data['group'] = $this->Groups_model->get_list();
      loadLayout('admin/jobPost/jobPostEdit', $data, 'admin');
    }
    else
    {
    // if ((strtotime($_POST['start_date'])) > (strtotime($_POST['last_date'])))
    // {
    //    $this->session->set_flashdata('error', 'Apply last date should be less then apply start date' );
    //    redirect('admin/JobPost');
    // }
    // if ((strtotime($_POST['min_age_date'])) > (strtotime($_POST['max_age_date'])))
    // {
    //    $this->session->set_flashdata('error', 'Max age should be greater then apply Min age');
    //    redirect('admin/JobPost');
    // }
    
    $cat = $this->input->post('category');
    $quatity = $this->input->post('post_quatity');
    // $post_quantity = array();

   for ($i=0; $i < count($quatity); $i++) { 
    if($quatity[$i] != ""){
      $post_quantity[] = $quatity[$i];
    }
   
   }
   $categorybytotalquatity = array_sum($post_quantity);
   if($categorybytotalquatity > $this->input->post('total_num_jobs')){
   $this->session->set_flashdata('error', 'Category Job Quatity Greater Then Total Number Of Jobs' );
   redirect('admin/JobPost/edit');
   }
   if(!empty($this->input->post('experience'))){
    $experience =  365 * $this->input->post('experience');
}
      $categories = array_combine($cat,$post_quantity);
      // print_r($categories);
      // die();
      $categories = json_encode($categories);

      $data = array(
        'post_name'      => $this->input->post('post_name'),
        'group_id'       => $this->input->post('group_id'),
        'total_num_jobs' => $this->input->post('total_num_jobs'),
        'fee_applicable' => $this->input->post('fee_applicable'),
        'fee_categories' => $this->input->post('fee_categories'),
        'category_type'  => $this->input->post('category_type'),
        'experience'     => $experience,
        'post_status'    => $this->input->post('post_status'),
        'start_date'     => $this->input->post('start_date'),
        'last_date'      => $this->input->post('last_date'),
        'min_age_date'   => $this->input->post('min_age_date'),
        'max_age_date'   => $this->input->post('max_age_date'),
        'adver_id'       => $this->input->post('adver_id'),
        'categories'     => $categories
        );
		
      $this->JobPost_model->insert_update($data, $post_id);

      $this->session->set_flashdata('success', 'Data saved Successfully');
	  $this->load->helper('common');
	  $audit_data = array('user_login_id' => 1,
						'page_id'           => 3,
						'page_name'         => "Add/Edit JobPost",
						'page_action'       => "Add/Edit",
						'page_category'     => "Add/Edit",
						'lang'      		=> "Eng",
						'page_title'        => 'Add/Edit user',
						'approve_status'    => "1",
						'usertype'          => "admin"
					);
	audit_trail($audit_data);

      redirect('admin/JobPost');

    }
  }

  public function delete($post_id)
  {
    if(!has_admin_permission_layout('JOB_POST')) { return; }
    if( $this->JobPost_model->delete_record($post_id)){
      $this->session->set_flashdata('success', 'Deleted Sucessfully');
    $this->load->helper('common');
	$audit_data = array('user_login_id' => 1,
						'page_id'           => 3,
						'page_name'         => "Delete JobPost",
						'page_action'       => "Delete",
						'page_category'     => "Delete",
						'lang'      		=> "Eng",
						'page_title'        => 'Delete user',
						'approve_status'    => "1",
						'usertype'          => "admin"
					);
	audit_trail($audit_data);
      redirect('admin/JobPost');
    }
  }

  public function get_groupby_data()
  {
    $id = $this->input->post('group_id');
    $res = $this->JobPost_model->get_group_data($id);
    // $final= json_decode($res);
    echo json_encode($res);die;

  }
  public function groupby_fee($id)
  {
    $res = $this->JobPost_model->groupbyfee($id);
   

  }
  public function view($post_id)
  {
    $data = array();
      $result =  $this->JobPost_model->get_jobPost($post_id);
      if(!$result) { ("Invalid Data");}
      $data['ddata']= $result;
      $data['categories'] = $this->Category_model->get_list();
      $data['group'] = $this->Groups_model->get_list();
 
    // $data = $this->User_model->getUser($uId);
		if(!empty($data)) {
		 $this->load->view('admin/jobPost/view_job', $data);
		 return;
		}
		echo '<h3 class="text-danger">Record not found!</h3>';
   
  }

}
