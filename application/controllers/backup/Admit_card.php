<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admit_card extends CI_Controller {
	function __construct(){
        parent::__construct();
    }

	public function index()
	{
	  $data = null;
	  loadLayout('home/admit_card', $data);

	}

  
}
