<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends CI_Controller {
   function __construct(){
        parent::__construct();

        $this->load->model('loginmodel','',TRUE);
    }
   function index(){
        if(isset($_COOKIE['remember_me'])){
            setcookie('remember_me', '', time()-7000000, '/');
        }
		
		$data = array('flag_id' => 0);
		$update = array('admin_id' => $_SESSION['ADMIN']['admin_id']);
		$this->loginmodel->updateflag($data,$update);
        $this->session->sess_destroy();
         redirect(base_url('login'));
    }
}