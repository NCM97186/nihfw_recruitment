<?php

class Admitcard extends CI_Controller
{

  function __construct() {
      parent::__construct();
      $this->load->model('JobPost_model');
      $this->load->model('Admit_card_model');
      $this->load->model('Users_model','users');
      $this->load->library('session');
      $this->load->model('Participants_model');
      $this->load->model('Advertisement_model');
      $this->load->model('Category_model');
      $this->load->helper('common_helper','common',TRUE);
      $this->admin_info     =  $this->common->__check_session();
  }

  public function index(){

      if(!has_admin_permission_layout('ADMIT_CARD')) { return; }
      if(isset($_REQUEST['advertisement_ID']) && $_REQUEST['advertisement_ID'] != 0){
        $advertise = $_REQUEST['advertisement_ID'];
      }else{
        $advertise = '';
      }
  
      if(isset($_REQUEST['Post_ID']) && $_REQUEST['Post_ID'] != 0){
        $postid = $_REQUEST['Post_ID'];
      }else{
        $postid = '';
      }
  
      if(isset($_REQUEST['Category_ID']) && $_REQUEST['Category_ID'] != 0){
        $category_id = $_REQUEST['Category_ID'];
      }else{
        $category_id = '';
      }
  
      if(isset($_REQUEST['Gender_ID']) && $_REQUEST['Gender_ID'] != 0){
        $gender_id = $_REQUEST['Gender_ID'];
      }else{
        $gender_id = '';
      }
  
      if(isset($_REQUEST['StatusFilter_ID']) && $_REQUEST['StatusFilter_ID'] != 0){
        $status_id = $_REQUEST['StatusFilter_ID'];
      }else{
        $status_id = '';
      }
  
      if(isset($_REQUEST['adver_datef']) && isset($_REQUEST['adver_datet'])){
        $fromdate = $_REQUEST['adver_datef'];
        $todate = $_REQUEST['adver_datet'];
      }else{
        $fromdate = '';
        $todate = '';
      }
      $export='';
      $query=$this->db->get('cand_profile_status_master');
      $data['candprofilestatus']=$query->result();
      $data['advertisement'] = $this->Advertisement_model->get_list();
      $data['jobpost'] = $this->JobPost_model->get_list(); 
      $data['category'] = $this->Category_model->get_list();
      $data['applicant_list']=$this->Admit_card_model->get_card_lists($advertise,$postid,$gender_id,$category_id,$status_id,$fromdate, $todate,$export);
      loadLayout('admin/admitcard/admitcard', $data, 'admin');
  }
  public function import()   {
  
    if(!has_admin_permission_layout('ADMIT_CARD')) { return; }
    $data = array();
  
    if(isset($_POST['upload']) && isset($_FILES["admitcard"]['name'])){
   // print_r($_SESSION);
      $file_name = $_FILES["admitcard"]['name'];
      if ($file_name) {
        $file_name = $_FILES["admitcard"]['name'];
        $user_id=$_SESSION['ADMIN']['admin_id'];
        
        $unlink ='uploads/admitcart/csv/'.$user_id."_".$file_name; //die();
        
        if (file_exists($unlink)) {
          unlink($unlink);
        }
        $config['upload_path'] = 'uploads/admitcart/csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1024';
        $config['file_name'] = $user_id."_".$file_name;;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('admitcard')) {
          $upload_data = $this->upload->data();
          $admitcard = $upload_data['file_name'];
          $data['admitcard'] = $user_id."_".$file_name;
        } else {
          $error = array('error' => $this->upload->display_errors());
          $label = "Records successfully uploaded";
          $this->session->set_flashdata('success', ' Records successfully uploaded');
         
				
        }
       $filepath ='uploads/admitcart/csv/'.$user_id."_".$file_name; 
        $file = fopen($filepath, "r");
        $importData_arr = array(); 
        $i = 0;
        
        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
        $num = count($filedata);
        
        if ($i == 0) {
          $i++;
          continue;
          }
          for ($c = 0; $c < $num; $c++) {
            $importData_arr[$i][] = $filedata[$c];
          }
            $i++;
        }
          fclose($file); 
          $j = 0;
          $instructions1= $this->input->post('instruction');
          foreach ($importData_arr as $importData) {
             // $post_id =        $importData['post_id'];
              // $roll_no =        $importData['Roll No']; 
              // $application_id = $importData['Application ID']; 
              // $date_time =      $importData['Date Time']; 
              // $venu_address =   $importData['Venu Address']; 
              // $instructions =   $importData['Instructions']; 
              // $tier =           $importData['Tier']; 
              $roll_no =        $importData['0']; 
              $application_id = $importData['1']; 
              $date=            $importData['2']; 
              $time=            $importData['3']; 
              $venu_address =   $importData['4']; 
              $instructions =   $instructions1; 
              $tier =           $importData['5']; 
              $create_by =      $user_id; 
              $inserteddata=[
              //'post_id'=>         !empty($post_id)?trim($post_id):'',
              'roll_no'=>         !empty($roll_no)?trim($roll_no):'',
              'application_id'=>  !empty($application_id)?trim($application_id):'',
              'date'=>            !empty($date)?trim($date):'',
              'time'=>            !empty($time)?trim($time):'',
              'venu_address'=>    !empty($venu_address)?trim($venu_address):'',
              'instructions'=>    !empty($instructions)?trim($instructions):'',
              'tier'=>            !empty($tier)?trim($tier):'',
              'create_by'=>       !empty($create_by)?trim($create_by):'',
            ];
            
              $j++;
            
            
            if(isset($_POST['upload'])){ 
              $canid = $this->Admit_card_model->checkedcanid($roll_no,$application_id,$tier);
                if(empty($canid)){
                  $caninid = $this->Admit_card_model->save($inserteddata);
                
                }else{
                  $this->session->set_flashdata('error', 'Alredy issue admit card');
                }
                $label =  'upload!';
            }else{
              
            }
          
          }
          $label =  'Records successfully uploaded';
        
        } else {
          $label =  'No file was uploaded';
        
        }
    }
    loadLayout('admin/admitcard/importadmitcard', $data, 'admin');
  }
    

}    