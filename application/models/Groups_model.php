<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Groups_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();
        }
function get_list(){
        $query = $this->db->query('select * from `groups` ORDER BY name');
        return $query->result();
    }
    public function get_group($group_id)
    {
        return  $this->db->get_where('groups', array('id' => $group_id))->row();
    }


    public function insert_update($data, $group_id = 0) 
    {
        if($group_id == 0){
            return $this->db->insert('groups', $data);
        }else{
            $this->db->where('id', $group_id);
            return $this->db->update('groups', $data);
        }
    }  
    public function delete_record($group_id)
    {
         $this->db->where('id', $group_id);
         return $this->db->delete('groups');
    }
}