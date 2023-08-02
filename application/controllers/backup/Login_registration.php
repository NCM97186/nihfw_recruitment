<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_registration extends CI_Controller {
	function __construct(){
        parent::__construct();
    }

	public function index()
	{
	  $data = null;
	  loadLayout('home/loginRegistration', $data);

	}

  
}
