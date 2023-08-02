<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basic_info extends CI_Controller {
	function __construct(){
        parent::__construct();
    }

	public function index()
	{
	  $data = null;
	  loadLayout('home/basicInfo', $data);

	}

  
}
