<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Audit_model extends CI_Model {

	private $table;
	
	public function __construct()
	{
			
			parent::__construct();
			
			$this->table = 'audit_trail';
	}
	
	
	public function get($start, $end, $fields, $where, $orderby, $count = false)
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
		//$audit_id =  $this->db->insert_id();
	}
	
	
}