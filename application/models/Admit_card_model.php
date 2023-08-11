<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Admit_card_model extends CI_Model {

	private $table;
	
	public function __construct()
	{
			
			parent::__construct();
			
			$this->table = 'admit_card';
	}
	
	
	public function get_card_lists($advertise,$postid,$gender_id,$category_id,$status_id,$fromdate, $todate,$export)
    {
        $sqlquery = '';
        $sqlquery .= 'SELECT cf.application_id	
		,cf.name	,cf.status_id,cf.post_id
		,cf.benchmark
		,cf.department	
		,cf.category_name	
		,cf.category_attachment	
		,cf.person_disability	
		,cf.add_disablity	
		,cf.dob	
		,cf.dob_doc	
		,cf.gender	
		,cf.marital_status	
		,cf.father_name	
		,cf.mother_name	
		,cf.identity_proof	
		,cf.adhar_card_number	
		,cf.adhar_card_doc	
		,cf.corr_address	
		,cf.corr_state	
		,cf.corr_pincode	
		,cf.perm_address	
		,cf.perm_state	
		,cf.perm_pincode	
		,cf.photograph	
		,cf.signature	
		,udr.deg	
		,udr.year	
		,udr.sub	
		,udr.uni	
		,udr.div	
		,udr.per	
		,udr.file_path
		,uwe.to_date	
		,uwe.organization	
		,uwe.post_held	
		,uwe.pay_scale	
		,uwe.from_date	
		,uwe.file_path	
		,jp.post_name
		,adv.adver_no	
		,adv.adver_title,dc.roll_no,dc.date ,dc.time,dc.venu_address,dc.tier,dc.instructions	FROM
				users_detail cf
			INNER JOIN jobpost jp ON cf.post_id = jp.post_id
			INNER JOIN advertisement adv ON  adv.adver_id = jp.adver_id
			INNER JOIN users_degree udr ON  udr.application_id = cf.application_id
			left JOIN users_work_experience uwe ON  uwe.application_id = cf.application_id
			INNER JOIN admit_card dc ON  dc.application_id = cf.application_id where 1';
				if($advertise){
					$sqlquery .= ' AND adv.adver_id = '.$advertise.'';
				}
				if($postid){
				$sqlquery .= ' AND cf.post_id = '.$postid.'';
				}
				if($category_id){
					$result = $this->db->select('category')->from('category')->where('id', $category_id)->limit(1)->get()->row();
					$catname= $result->category;
					if($catname){
						$sqlquery .= ' AND cf.category_name like "%'.$catname.'%"'; 
					}
				
				}
				if($status_id){
					$sqlquery .= ' AND cf.status_id = '.$status_id.'';
				}
				if($gender_id){
					if($gender_id=1){
						$gender="Male";
					}elseif($gender_id=2){
						$gender="Female";
					}else{
						$gender="Other";
					}
					$sqlquery .= ' AND cf.gender like "%'.$gender.'%"';
				}
				if($fromdate && $todate){
					$sqlquery .= ' AND cf.created_on between "'.$fromdate.' 00:00:00" AND "'.$todate.' 23:59:59"';
				}
				elseif($fromdate ){
					$sqlquery .= ' AND cf.created_on like "%'.$fromdate.'%" ';
				}
				elseif($todate){
					$sqlquery .= ' AND cf.created_on  like "%'.$todate.'%"';
				}
		
				//echo  $sqlquery;
				$query = $this->db->query($sqlquery);
				if($export){
					return $query->result_array();
				}else{
					return $query->result();
				}
				
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