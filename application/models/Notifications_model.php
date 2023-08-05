<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Notifications_model extends CI_Model
{
//it is commonn for Notifications and Home
    function __construct() {
        parent::__construct();
        }

    public function get_jobPost(){

      $query = $this->db->query('select j.*,a.adver_no,a.adver_date,a.link_to_pdf,ud.status_id
      from jobpost j inner join advertisement a on j.adver_id=a.adver_id
      left join users_detail ud on ud.post_id=j.post_id
      where j.post_status=1 AND last_date >= CURDATE() AND CURDATE() >= start_date');
      /*$query = $this->db->query('select j.*,a.adver_no,a.adver_date,a.link_to_pdf
        from jobpost j inner join advertisement a on j.adver_id=a.adver_id
        where j.post_status=1 AND last_date >= CURDATE() AND j.post_id='.$post_id 
        );*/
      return $query->result();
    }

    function get_list(){ //this is for linelist
        $query = $this->db->query('select j.*,a.adver_no,a.adver_date,a.link_to_pdf
          from jobpost j inner join advertisement a on j.adver_id=a.adver_id
          where j.post_status=1 
          order by j.created_date');
        return $query->result();
    }
public function getCandID(){
  $query=$this->db->query('select max(cand_id) as cand_id  from cand_profile');
  return $query->row();
}
    public function insert_update($data)
        {
          

                $this->db->insert('cand_profile', $data);
                //echo $this->db->last_query(); die;

        }
    public function insertQual($data){
      $this->db->insert('qualification',$data);
    }

    public function delete_record($post_id)
       {
            $this->db->where('post_id', $post_id);
            return $this->db->delete('jobpost');
       }
	   
	
	

    }
