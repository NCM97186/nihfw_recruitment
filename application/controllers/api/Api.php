<?php
require APPPATH . 'libraries/REST_Controller.php';

class Api extends REST_Controller
{
    public function __construct() {
       parent::__construct();
       $this->load->database();
	   $this->load->model('Notifications_model');
    }
	public function index_get($id = 0)
	{
		  $this->load->library('format'); 

        if(!empty($id)){
            $data = $this->db->get_where("advertisement", ['id' => $id])->row_array();
        }else{
            $data =  $this->Notifications_model->get_list();
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
	}
}
