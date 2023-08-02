<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->admin_info     =  $this->common->__check_session();
        $this->load->model('loginmodel','',TRUE);
		$this->load->helper('common_helper','common',TRUE);
		// check_cookies();
    }
	
	public function index()
	{
		/*echo '<pre>';
		print_r(session_id());
		print_r($_SESSION);
		die();*/
	  $data = null;
	  $where = array('admin_id' => $_SESSION['ADMIN']['admin_id']);
        $res = $this->loginmodel->view_single($where);
		if($res['last_session']!= session_id()){
			header("Location:".site_url('/logout'));
			exit();
			}
	  loadLayout('admin/welcome', $data,'admin');

	}
	public function hearbeat(){
		$data = array('flag_id' => time(),'last_session'=>session_id());
		if(isset($_SESSION['ADMIN']['admin_id'])){
			$update = array('admin_id' => $_SESSION['ADMIN']['admin_id']);
			$this->loginmodel->updateflag($data,$update);
			echo json_encode(array("status"=>"success"));
			exit();
		}
		echo json_encode(array("status"=>"error"));
		exit();
    }
	

}
