<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate_view extends CI_Controller {
	function __construct(){
        parent::__construct();
	    	$this->load->model('Candidate_view_model');

    }

	public function index($cand_id)
	{

	   $data = null;

       $data['results']=$this->Candidate_view_model->get_candidate($cand_id);
       $data['qualification']=$this->Candidate_view_model->getQualification($cand_id);

	   loadLayout('home/candidate_view', $data);

	}




	}
