<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Notifications extends CI_Controller {
	function __construct(){
        parent::__construct();
				$this->load->model('Notifications_model');


    }

	public function index()
	{
     
	    $data = null;
        $result=$this->Notifications_model->get_list();
         $data['result']=$result;
	   //print_r($result);die;
	   loadLayout('home/notifications', $data);

	}


	public function page()
	{
		$this->load->view('page/page');
	}



}
