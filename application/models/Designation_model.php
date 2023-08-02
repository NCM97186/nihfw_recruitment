<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Designation_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();
        }

    public function get_designation($designation_id){

        return  $this->db->get_where('m_designation', array('designation_id' => $designation_id))->row();
    }

    function get_list(){
        $query = $this->db->query('select * from m_designation ORDER BY designation_name');
        return $query->result();
    }

    public function insert_update($data, $designation_id = 0) 
        {
            if($designation_id == 0){
                return $this->db->insert('m_designation', $data);
            }else{
                $this->db->where('designation_id', $designation_id);
                return $this->db->update('m_designation', $data);
            }        
        }

    public function delete_record($designation_id)
       {
            $this->db->where('designation_id', $designation_id);
            return $this->db->delete('m_designation');
       }

    }