<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Admit_card_model extends CI_Model {

	private $table;
	
	public function __construct()
	{
			
			parent::__construct();
			
			$this->table = 'admit_card';
	}
	
	
	public function index($start, $end, $fields, $where, $orderby, $count = false)
	{
		
		
	}
    public function checkedcanid($roll_no,$application_id,$tier){
		$where=['roll_no'=> $roll_no,'application_id'=> $application_id,'tier'=> $tier];
        $this->db->where($where);
		$card = $this->db->get('admit_card');
		$datacard = $card->result_array();
		if($datacard){
			return $datacard[0]['id'];
		}
		
	}  
        
	public function save($data)
	{
		$this->db->insert($this->table, $data);

		return $admit_card_id =  $this->db->insert_id();
	}
	
	
}