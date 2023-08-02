<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Department_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();
        }

    public function get_department($department_id){

        return  $this->db->get_where('m_department', array('department_id' => $department_id))->row();
    }

    function get_list(){
        $query = $this->db->query('select * from m_department  order by department_name');
        return $query->result();
    }

    public function insert_update($data, $department_id = 0) 
        {
            if($department_id == 0){
                return $this->db->insert('m_department', $data);
            }else{
                $this->db->where('department_id', $department_id);
                return $this->db->update('m_department', $data);
            }        
        }

    public function delete_record($department_id)
       {
            $this->db->where('department_id', $department_id);
            return $this->db->delete('m_department');
       }

    }