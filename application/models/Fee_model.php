<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Fee_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();
        }

    function get_fee_list(){
        $this->db->select('*');
        $this->db->from('category');
        $this->db->join('fee', 'category.id= fee.cat_id');
        $this->db->join('groups', 'fee.group_id = groups.id');
        $query = $this->db->get();
        return $query->result();
        }
    
    
    public function get_fee($id)
    {
        return  $this->db->get_where('fee', array('fee_id' => $id))->row();
    }


    public function insert_update_feedata($data, $id = 0) 
    {
        if($id == 0){
            return $this->db->insert('fee', $data);
        }else{
            $this->db->where('fee_id', $id);
            return $this->db->update('fee', $data);
        }
    } 
    public function delete_fee_record($id)
    {
         $this->db->where('fee_id', $id);
         return $this->db->delete('fee');
    } 

}   
 