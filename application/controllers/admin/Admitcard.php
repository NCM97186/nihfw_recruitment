<?php

class Admitcard extends CI_Controller
{

  function __construct() {
    parent::__construct();
    $this->load->model('JobPost_model');
    $this->load->library('session');
    $this->load->helper('common_helper','common',TRUE);
    $this->admin_info     =  $this->common->__check_session();
    }

    public function index(){

    if(!has_admin_permission_layout('ADMIT_CARD')) { return; }
    $data = array();
    loadLayout('admin/admitcard/admitcard', $data, 'admin');
  }
    

}    