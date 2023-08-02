<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class JobPost_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        }

    public function get_jobPost($post_id){

        return $this->db->get_where('jobpost', array('post_id' => $post_id))->row();
    }

    function get_list(){ 
        $query = $this->db->query('select j.*,a.adver_title as title

          from jobpost j inner join advertisement a on j.adver_id=a.adver_id   order by post_name');
        return $query->result();
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

    public function delete_record($post_id)
       {
            $this->db->where('post_id', $post_id);
            return $this->db->delete('jobpost');
       }
    public function get_group_data($id)
    {
        $this->db->select('*');
        $this->db->from('fee');
        $this->db->join('category', 'fee.cat_id = category.id');
        $this->db->where('group_id',$id);
        $result= $this->db->get()->result();
       
        return $result;

    }

    }
