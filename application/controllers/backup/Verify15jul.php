<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_Controller {
	function __construct(){
        parent::__construct();
	    	$this->load->model('Verify_model');

    }

	public function index()
	{
		$this->load->helper('string');
	   $data = null;


        $otp=random_string('numeric', 5);
        $_SESSION['user_otp'] = $otp;

		 //$this->session->userdata();
	   loadLayout('home/verify', $data);

	}
	public function verify_otp(){

		$r_otp= $_POST['otp_text'];
		$s_otp=$_SESSION['user_otp'];
		if($r_otp==$s_otp){
			echo "varified";die;
		}
		else{
			echo "not varified";die;
		}
	}



	}
