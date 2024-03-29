<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Participants_model extends CI_Model
{

    function __construct() {
        parent::__construct();
      }

    function get_filteredlist($advertise,$postid,$gender_id,$category_id,$status_id,$fromdate,$todate ,$export){
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
,adv.adver_title	FROM
        users_detail cf
    INNER JOIN jobpost jp ON cf.post_id = jp.post_id
    INNER JOIN advertisement adv ON  adv.adver_id = jp.adver_id
    INNER JOIN users_degree udr ON  udr.application_id = cf.application_id
    left JOIN users_work_experience uwe ON  uwe.application_id = cf.application_id
    where 1
    ';
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
  
        //  $sqlquery;
        $query = $this->db->query($sqlquery);
        if($export){
            return $query->result_array();
        }else{
            return $query->result();
        }
        
       
    }

    function get_list(){
        $query = $this->db->query('SELECT
    cf.*,
    jp.post_name,
    adv.adver_title,
    X.status_id
FROM
    cand_profile cf
INNER JOIN jobpost jp ON
    cf.post_id = jp.post_id
LEFT JOIN advertisement adv ON
    adv.adver_id = jp.adver_id
LEFT JOIN(
    SELECT
        a.cand_vari_id,
        a.cand_id,
        a.status_id
    FROM
        cand_profile_status a
    INNER JOIN(
        SELECT
            b.cand_id,
            MAX(b.cand_vari_id) AS b_cand_vari_id
        FROM
            cand_profile_status b
        GROUP BY
            b.cand_id
    ) t
ON
    a.cand_id = t.cand_id AND a.cand_vari_id = t.b_cand_vari_id
) X
ON
    cf.cand_id = X.cand_id

          ');
        return $query->result();
    }
  
    public function only_insert($data){
      return $this->db->insert('cand_profile_status',$data);
    }

    public function insert_update($data, $post_id = 0)
        {
            if($post_id == 0){
                return $this->db->insert('jobpost', $data);
            }else{
                $this->db->where('post_id', $post_id);
                return $this->db->update('jobpost', $data);
            }
        }
    public function get_candidate($cand_id){
      $query = $this->db->query('select i.*, j.post_name,j.max_age_date,a.adver_no,a.adver_date
        from cand_profile i
        left join jobpost j on i.post_id=j.post_id
        inner join advertisement a on j.adver_id=a.adver_id
        where i.cand_id='.$cand_id
        );
      return $query->row();
    }
    public function get_reg_candidates(){
        $this->db->select('*');
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result();
    }
    public function getQualification($cand_id){
      $query=$this->db->query('select * from qualification where cand_id='.$cand_id);
      return $query->result();
    }


    }
