<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Photo_sig extends CI_Controller {
	function __construct(){
        parent::__construct();
    }

	public function index()
	{
	  $data = null;
	  loadLayout('home/photoSig', $data);

	}

  
}
