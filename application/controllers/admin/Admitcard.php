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
        foreach ($importData_arr as $importData) {
          $name = $importData[0];
          $email = $importData[1]; 
          $password = $importData[2]; 
          $j++;
          
          $where=['post_id'=> $post_id,'roll_no'=> $roll_no,'application_id'=> $application_id,'tier'=> $tier];
          $this->db->where($where);
					$card = $this->db->get('admit_card');
					$datacard = $card->result_array();
					$canid = $datacard[0]['id'];
         if(isset($_POST['confirm'])){ 

            if(empty($canid)){
            
            }else{
              $label =  'Some thing Worng!';
            }
            $label =  'Confirm!';
        }else{
          $label =  'Review  And Confirm!';
        }
        
        }
        $label =  'Records successfully uploaded';
      
      } else {
        $label =  'No file was uploaded';
      
      }
    loadLayout('admin/admitcard/importadmitcard', $data, 'admin');
  }
    

}    