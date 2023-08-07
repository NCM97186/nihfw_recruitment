<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Amit_card_model extends CI_Model {

	private $table;
	
	public function __construct()
	{
			
			parent::__construct();
			
			$this->table = 'admit_card';
	}
	
	
	public function index($start, $end, $fields, $where, $orderby, $count = false)
	{
		$select  = "SELECT ".$fields." FROM ".$this->table;
		$where  = " WHERE  ".$where;
		
		$limit  = "";
		if($end > 0){
			$limit  = " LIMIT ".$end." OFFSET ".$start;
		}
		
		$query = $this->db->query($select.$where.$orderby.$limit);
		
		$result = $query;
		
		if($count == true){
			$query  = $this->db->query($select.$where);
			$result = $query->num_rows();
		}
		
		return $result;
		
	}
        
        
	public function save( $data = array() )
	{
		$this->db->insert($this->table, $data);

		return $admit_card_id =  $this->db->insert_id();
	}
	
	
}