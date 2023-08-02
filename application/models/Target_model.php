<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Target_model extends CI_Model
{
	public function __construct()
	{
		global $db;
		parent::__construct();
	}

	public function saveTarget($post_val,$blocks)
	{
		$rid = $_SESSION['ROUND_CHOICE'];
		//$i=0;
		$freeze = 0;
		//echo "<pre>";print_r($post_val);

		if(isset($post_val['final_submit'])) {
			$freeze = 1;
		}

		foreach($blocks as $block)
		{
			//echo "Alan"; die;
			//$i++;	
			//echo $rid; echo ' '. $block['Block_ID']; 
			$this->db->where('Block_ID',$block['Block_ID']);
			$this->db->where('round_id',$rid);		
			
			$row = $this->db->get("target");
			$datas = $row->result_array();
			//$count_val = $this->db->count_all_results(); 

			$count_val =  count($datas);

			//echo "<pre>";
			//print_r($datas);die;
			if( isset($datas[0]['freeze']) &&  $datas[0]['freeze'] == 1) {
			 	continue;
			}

			if(trim($post_val[$block['Block_ID']."_planned_urban"])==''){
				$planned_urban=NULL;
			}else{
				$planned_urban=intval(trim($post_val[$block['Block_ID']."_planned_urban"]));
			}

			if(trim($post_val[$block['Block_ID']."_planned_rural"])==''){
				$planned_rural=NULL;
			}else{
				$planned_rural=intval(trim($post_val[$block['Block_ID']."_planned_rural"]));
			}	

			if(trim($post_val[$block['Block_ID']."_no_of_target_children_urban"])==''){
				$no_of_target_children_urban=NULL;
			}else{
				$no_of_target_children_urban=intval(trim($post_val[$block['Block_ID']."_no_of_target_children_urban"]));
			}			
			
			if(trim($post_val[$block['Block_ID']."_no_of_target_children_rural"])==''){
				$no_of_target_children_rural=NULL;
			}else{
				$no_of_target_children_rural=intval(trim($post_val[$block['Block_ID']."_no_of_target_children_rural"]));
			}

			if(trim($post_val[$block['Block_ID']."_no_of_target_women_urban"])==''){
				$no_of_target_women_urban=NULL;
			}else{
				$no_of_target_women_urban=intval(trim($post_val[$block['Block_ID']."_no_of_target_women_urban"]));
			}

			if(trim($post_val[$block['Block_ID']."_no_of_target_women_rural"])==''){
				$no_of_target_women_rural=NULL;
			}else{
				$no_of_target_women_rural=intval(trim($post_val[$block['Block_ID']."_no_of_target_women_rural"]));
			}

			$data = array(

					'Block_ID' => $block['Block_ID'],
					'round_id' => $rid,
					'planned_urban' => $planned_urban,
					'planned_rural' => $planned_rural,
					'no_of_target_children_urban' => $no_of_target_children_urban,
					'no_of_target_children_rural' => $no_of_target_children_rural,
					'no_of_target_women_urban' => $no_of_target_women_urban,
					'no_of_target_women_rural' => $no_of_target_women_rural,
					'updated_by' => $_SESSION['ADMIN']['admin_id'],
					'freeze' => $freeze
					);
				//echo "<pre>";
				//print_r($data);die;
			if($count_val >0) 
			{		
				if(trim($block['Block_ID'])!='' && trim($rid)!='')	
				{
					$this->db->where('Block_ID',$block['Block_ID']);
					$this->db->where('round_id',$rid);          
					if(!$this->db->update('target', $data)){
					  return FALSE;
					}
				}		
			}
			else
			{	
				if(trim($block['Block_ID'])!='' && trim($rid)!='' &&  $freeze == 0)			
				{			 
					if(!$this->db->insert('target', $data)){
					  return FALSE;
					}
				}				 			
			}					 
		}
		
		return true;
	}	

	//To display all blocks within target form
	public function getBlockListWithData($filterArray,$round_id)
	{
		$queryWhere = $filterArray['WHERE'];

		$query = "SELECT t.*, m.Block_Name, m.Block_ID FROM m_block m 

		LEFT JOIN target t ON m.`Block_ID` = t.Block_ID 
		AND t.round_id = '".intval($round_id)."' " ;
		
		if(!empty($queryWhere)) {
		  $query .= " WHERE " . implode(' AND ', $queryWhere). "";
		}

		$query = $this->db->query($query);
		return  $query->result_array();
	}
public function get_total()
{
    return $this->db->count_all("target_log");

}
public function get_last_calculated_total()
{
    $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
	return $query->row()->Count;
    
}

public function getLogData($filterArray,$round_id,$limit=0,$start=0)
	{

		$queryWhere = $filterArray['WHERE'];
		
		$query = "SELECT SQL_CALC_FOUND_ROWS
					s.State_Name,
					s.State_ID,
					d.District_ID,
					d.District_Name,
					b.Block_ID,
					b.Block_Name,
					t.*
					
				 FROM
					m_block b
					LEFT JOIN m_district d ON
							d.District_ID = b.District_ID
					LEFT JOIN m_state s ON
							s.State_ID = d.State_ID
					LEFT JOIN target_log t ON
						t.Block_ID = b.Block_ID";
						
		if($round_id > 0) {
			$query .=" WHERE t.round_id = '".$round_id."' ";
		}
		if(!empty($queryWhere)) {
		  $query .= " " . implode(' AND ', $queryWhere). "";
		}
		
		$query .=" ORDER BY t.id DESC";
		if($limit != 0 ){
			$query .=" LIMIT $start, $limit";
		}
		
		
		$q = $this->db->query($query);
		return  $q->result_array();
	}

	
	public function getBlockList($District_ID)
	{
		$query = " SELECT m.Block_Name, m.Block_ID, m.District_ID
		FROM m_block m
		where District_ID = " . intval($District_ID)  .' order by m.Block_Name';
		$query = $this->db->query($query);
		return  $query->result_array();
	}
	
}
