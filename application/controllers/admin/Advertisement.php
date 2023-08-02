<?php

class Advertisement extends CI_Controller
{

  function __construct() {
    parent::__construct();
	$this->admin_info     =  $this->common->__check_session();
    $this->load->model('Advertisement_model');
    }
  public function index()
  {
    if(!has_admin_permission_layout('ADVERTISEMENT')) { return; }
    $data = array();
    $result = $this->Advertisement_model->get_list(); //it loads a complete list of advertisement
    $data['ddata']=$result;
    loadLayout('admin/advertisement/advertisement', $data, 'admin');
  }

  public function edit($adver_id = 0)  //when click on add button or edit button
  {
	
    if(!has_admin_permission_layout('ADVERTISEMENT')) { return; }

    $data = array();
    if($adver_id != 0) { //on edit with data on the basis of id
      $result =  $this->Advertisement_model->get_advertisement($adver_id);
      if(!$result) { die("Invalid Data");}
      $data['ddata']= $result;
    } //if if condition is false then without data page will be load that means for new entry
    
    loadLayout('admin/advertisement/advertisementEdit', $data, 'admin');
  }

  public function update($adver_id = 0) //it is for update or insert new record
  {
    if(!has_admin_permission_layout('ADVERTISEMENT')) { return; }
    $this->load->library('form_validation');
    $this->form_validation->set_rules('adver_no', 'Advertisement No', 'required');
    $this->form_validation->set_rules('adver_title', 'Advertisement Title', 'required');
	if(empty($_FILES['link_to_pdf']['name'])&&empty($this->input->post('old_link_to_pdf'))) {
		$this->form_validation->set_rules('link_to_pdf', 'Advertisement File', 'required');
	}
    $this->form_validation->set_rules('adver_date', 'Advertisement date', 'required');

	 $link_to_pdf="";
    if($this->form_validation->run() == FALSE)
    {

      $data = array();
      loadLayout('admin/advertisement/advertisementEdit', $data, 'admin');
    }
    else
    {	
     
			if(isset($_FILES['link_to_pdf']) && $_FILES['link_to_pdf']['name'] != '') {
      
					$file_name = time() . '_' . $_FILES["link_to_pdf"]['name'];
         
					$config['upload_path'] = 'uploads/link_to_pdf';
       
					$config['allowed_types'] = 'doc|docx|pdf|jpg|jpeg|png';
					$config['max_size'] = '3072';
					$config['file_name'] = $file_name;
         
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
       
					if($this->upload->do_upload('link_to_pdf')) {
          
						$upload_data = $this->upload->data();
						$link_to_pdf = $upload_data['file_name'];
           
					} 
          else {
						$error = array('error' => $this->upload->display_errors());
         
						$label="Link To PDF";
					}
			}else{
       
          $link_to_pdf = $this->input->post('old_link_to_pdf');
      
      }
      $data = array(
        'adver_no' => $this->input->post('adver_no'),
        'adver_title' => $this->input->post('adver_title'),
        'link_to_pdf' => $link_to_pdf,
        'adver_date' => $this->input->post('adver_date')
        );
      
        //if $department_id is not 0 that means update otherwise insert
      $this->Advertisement_model->insert_update($data, $adver_id);

      $this->session->set_flashdata('success', 'Data saved Successfully');
	  $this->load->helper('common');
	  $audit_data = array('user_login_id' => 1,
						'page_id'           => 3,
						'page_name'         => "Add/Edit advertisement",
						'page_action'       => "Add/Edit",
						'page_category'     => "Add/Edit",
						'lang'      		=> "Eng",
						'page_title'        => 'Add/Edit user',
						'approve_status'    => "1",
						'usertype'          => "admin"
					);
	audit_trail($audit_data);

      redirect('admin/Advertisement');

    }
  }

  public function delete($adver_id)
  {
    if(!has_admin_permission_layout('ADVERTISEMENT')) { return; }
    if( $this->Advertisement_model->delete_record($adver_id)){
      $this->session->set_flashdata('success', 'Deleted Sucessfully');
	  $this->load->helper('common');
	  $audit_data = array('user_login_id' => 1,
						'page_id'           => 3,
						'page_name'         => "Delete advertisement",
						'page_action'       => "Delete",
						'page_category'     => "Delete",
						'lang'      		=> "Eng",
						'page_title'        => 'Delete user',
						'approve_status'    => "1",
						'usertype'          => "admin"
					);
	audit_trail($audit_data);
    redirect('admin/Advertisement');
    }
  }

}
