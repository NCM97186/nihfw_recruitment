<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Candidate_view_model extends CI_Model
{
//it is commonn for Notifications and Home
    function __construct() {
        parent::__construct();
        }

    public function get_candidate($cand_id){
      $query = $this->db->query('select i.*, j.post_name,a.adver_no,a.adver_date
        from cand_profile i
        left join jobpost j on i.post_id=j.post_id
        inner join advertisement a on j.adver_id=a.adver_id
        where i.cand_id='.$cand_id
        );
      return $query->result();
    }
    public function getQualification($cand_id){
      $query=$this->db->query('select * from qualification where cand_id='.$cand_id);
      return $query->result();
    }



    }
