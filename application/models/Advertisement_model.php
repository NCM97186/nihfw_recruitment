<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Advertisement_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        }

    public function get_advertisement($adver_id){ //this is for edit

        return $this->db->get_where('advertisement', array('adver_id' => $adver_id))->row();
    }

    function get_list(){ //this is for linelist
        $query = $this->db->query('select * from advertisement  order by adver_title');
        return $query->result();
    }

    public function insert_update($data, $adver_id = 0)
        {
            if($adver_id == 0){
                return $this->db->insert('advertisement', $data);
            }else{
                $this->db->where('adver_id', $adver_id);
                return $this->db->update('advertisement', $data);
            }
        }

    public function delete_record($adver_id)
       {
            $this->db->where('adver_id', $adver_id);
            return $this->db->delete('advertisement');
       }

    }
