<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Category_model extends CI_Model
{
    
    function __construct() {
        parent::__construct();
        }

    function get_list(){
        $query = $this->db->query('select * from category where status = "0" order by category');
        return $query->result();
    }
    public function get_category($category_id)
    {
        return  $this->db->get_where('category', array('id' => $category_id))->row();
    }


    public function insert_update($data, $category_id = 0) 
    {
        if($category_id == 0){
            return $this->db->insert('category', $data);
        }else{
            $this->db->where('id', $category_id);
            return $this->db->update('category', $data);
        }
    }  
    public function delete_record($category_id)
    {
         $this->db->where('id', $category_id);
         return $this->db->delete('category');
    }
   
    //// subcategory functions

    function get_subcategory_list(){
        $query = $this->db->query('select category.*,subcategory.*
        from category inner join subcategory on category.id=subcategory.category_id order by subcategory');
        return $query->result();
        }
    
    
    public function get_subcategory($subcategory_id)
    {
        return  $this->db->get_where('subcategory', array('id' => $subcategory_id))->row();
    }


    public function insert_update_subcategory($data, $subcategory_id = 0) 
    {
        if($subcategory_id == 0){
            return $this->db->insert('subcategory', $data);
        }else{
            $this->db->where('id', $subcategory_id);
            return $this->db->update('subcategory', $data);
        }
    } 
    public function delete_subcategory_record($subcategory_id)
    {
         $this->db->where('id', $subcategory_id);
         return $this->db->delete('subcategory');
    }
    public function makepdf($id)
    {
      $query =$this->db
                ->select('*')
                ->from('users_detail')
                ->where('users_detail.application_id',$id)
                ->join('users', 'users_detail.user_id=users.user_id', 'inner')
                ->join('jobpost', 'users_detail.post_id = jobpost.post_id', 'inner')
                 ->join('category', 'users_detail.category = category.id', 'inner')
                 ->join('users_degree', 'users.user_id = users_degree.user_id', 'inner')
                ->get();
                return $query->result();
	} 
    
}