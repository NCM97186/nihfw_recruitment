<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Payment_model extends CI_Model {

	private $table;
	
	public function __construct()
	{
			
			parent::__construct();
			
			$this->table = 'payment_status';
	}
	
	
	public function index($start, $end, $fields, $where, $orderby, $count = false)
	{
		
		
	}
    public function checkedcanid($application_id,$pay_tx_id){
		$where=['application_id'=> $application_id,'pay_tx_id'=> $pay_tx_id];
        $this->db->where($where);
		$card = $this->db->get('payment_status');
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