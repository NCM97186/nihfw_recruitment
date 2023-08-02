<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Age_category_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();
        }
  
  
function get_age_list(){
        $query = $this->db->query('select category.*,age_relaxation.*
        from category inner join age_relaxation on category.id=age_relaxation.catid');
        return $query->result();
        }
public function get_age_data($id)
    {
        return  $this->db->get_where('age_relaxation', array('id' => $id))->row();
    }

function get_data(){
        $query = $this->db->query('select category.*,age_relaxation.*
        from category inner join age_relaxation on category.id=age_relaxation.catid');
        return $query->result();
        }
public function insert_update_agedata($data, $id = 0) 
        {
            if($id == 0){
                return $this->db->insert('age_relaxation', $data);
            }else{
                $this->db->where('id', $id);
                return $this->db->update('age_relaxation', $data);
            }
        }
public function delete_agedata_record($id)
{
        $this->db->where('id', $id);
        return $this->db->delete('age_relaxation');
} 

}