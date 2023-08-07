<?php

class Admitcard extends CI_Controller
{

  function __construct() {
      parent::__construct();
      $this->load->model('JobPost_model');
      $this->load->model('Amit_card_model');
      $this->load->library('session');
      $this->load->helper('common_helper','common',TRUE);
      $this->admin_info     =  $this->common->__check_session();
  }

  public function index(){

      if(!has_admin_permission_layout('ADMIT_CARD')) { return; }
      $data = array();
      loadLayout('admin/admitcard/admitcard', $data, 'admin');
  }
  public function import()   {
  
    if(!has_admin_permission_layout('ADMIT_CARD')) { return; }
    $data = array();
  
    if(isset($_POST['upload'])){
    
      $file_name = $_FILES["admitcard"]['name'];
      if ($file_name) {
        $file_name = $_FILES["admitcard"]['name'];
        $user_id=$_SESSION['USER']['user_id'];
        
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
        }
     echo    $filepath ='uploads/admitcart/csv/'.$user_id."_".$file_name; die('Hello');
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
          print_r($importData_arr);
          foreach ($importData_arr as $importData) {
              $post_id =        $importData['post_id'];
              $roll_no =        $importData['roll_no']; 
              $application_id = $importData['application_id']; 
              $name =           $importData['name']; 
              $father_name =    $importData['father_name']; 
              $category =       $importData['category']; 
              $pwbd =           $importData['pwbd']; 
              $ex_serviceman =  $importData['ex_serviceman']; 
              $date_time =      $importData['date_time']; 
              $venu_address =   $importData['venu_address']; 
              $photograph =     $importData['photograph']; 
              $signature =      $importData['signature']; 
              $instructions =   $importData['instructions']; 
              $tier =           $importData['tier']; 
              $create_by =      $user_id; 
              $inserteddata=[
              'post_id'=>         !empty($post_id)?trim($post_id):'',
              'roll_no'=>         !empty($roll_no)?trim($roll_no):'',
              'application_id'=>  !empty($application_id)?trim($application_id):'',
              'name'=>            !empty($name)?trim($name):'',
              'father_name'=>     !empty($father_name)?trim($father_name):'',
              'category'=>        !empty($category)?trim($category):'',
              'pwbd'=>            !empty($pwbd)?trim($pwbd):'',
              'ex_serviceman'=>   !empty($ex_serviceman)?trim($ex_serviceman):'',
              'date_time'=>       !empty($date_time)?trim($date_time):'',
              'venu_address'=>    !empty($venu_address)?trim($venu_address):'',
              'photograph'=>      !empty($photograph)?trim($photograph):'',
              'signature'=>       !empty($signature)?trim($signature):'',
              'instructions'=>    !empty($instructions)?trim($instructions):'',
              'tier'=>            !empty($tier)?trim($tier):'',
              'create_by'=>       !empty($create_by)?trim($create_by):'',
            ];

              $j++;
            
            
            if(isset($_POST['confirm'])){ 
              $canid = $this->Amit_card_model->checkedcanid($post_id,$roll_no,$application_id,$tier);
                if(empty($canid)){
                  $caninid = $this->Amit_card_model->save($inserteddata);
                }else{
                  $label =  'Some thing Worng!';
                }
                $label =  'Confirm!';
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