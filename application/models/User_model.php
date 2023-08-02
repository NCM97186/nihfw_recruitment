
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class User_model extends CI_Model
{

	public function insert_user($data)
	{
	    return $this->db->insert('tbl_admin_login', $data);    
	}
	
    public function update_user($data, $admin_id) {
	
		 $this->db->where('admin_id',$admin_id);
		
		 return $this->db->update('tbl_admin_login', $data);
	}
	public function get_last_calculated_total()
	{
	    $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		return $query->row()->Count;
	    
	}
	public function getUserlist($filterArray,$per_page, $offset){
		$queryWhere = $filterArray['WHERE'];
		
		$query    	= "select SQL_CALC_FOUND_ROWS tbl_admin_login.*, tbl_admin_login.admin_id,tbl_admin_login.fname,tbl_admin_login.email,
		tbl_admin_login.mobile,tbl_admin_login.username,tbl_admin_login.status,
		tbl_admin_login.role_id,m_role.role_name,m_department.department_name,m_designation.designation_name
		

		from tbl_admin_login
		left join m_role on  tbl_admin_login.role_id = m_role.role_id
		left join m_department on  tbl_admin_login.department_id = m_department.department_id
		left join m_designation on  tbl_admin_login.designation_id = m_designation.designation_id
		where " . implode(' AND ', $queryWhere) . " ";
		$query .=" ORDER BY admin_id DESC LIMIT $offset, $per_page";
		$query = $this->db->query($query); 

		return  $query->result_array();		
	}

	public function getUser($admin_id){
	
		$array = array('tbl_admin_login.admin_id' => $admin_id);
		$this->db->select('tbl_admin_login.admin_id,tbl_admin_login.username, tbl_admin_login.fname, tbl_admin_login.mobile, tbl_admin_login.email, tbl_admin_login.status, tbl_admin_login.status as user_status, tbl_admin_login.role_id, m_role.role_name, m_department.department_id, m_department.department_name, m_designation.designation_id, m_designation.designation_name');
			
		$this->db->from('tbl_admin_login');
		
		$this->db->join('m_role', 'tbl_admin_login.role_id = m_role.role_id', 'left');
        $this->db->join('m_department', 'tbl_admin_login.department_id = m_department.department_id', 'left');
		$this->db->join('m_designation', 'tbl_admin_login.designation_id = m_designation.designation_id', 'left');
		$this->db->where($array);

		return  $this->db->get()->row_array();	
		
	}
	public function update_user_status($id, $status)
	{
		$data['status'] = $status;
		$this->db->where('id', $id);
		$this->db->update('tbl_admin_login', $data);
	}
		
	public function deleteUser($id)
	{
	    $this->db->where('id',$id);
	    $this->db->delete('tbl_admin_login');
	    
	    //echo $this->db->last_query();die;
	    if($this->db->affected_rows() > 0)
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	            
	        
	    }
	}
	
	public function getRole($role_id)
	{
	    $this->db->select('*');      
        $this->db->from('m_role');
		$this->db->where("role_id", $role_id);
	    $query = $this->db->get(); 
		return  $query->row_array();

	}

	public function getRoleList()
	{
	    $this->db->select('*');      
        $this->db->from('m_role');
		$this->db->order_by("role_name", "asc");
	    $query = $this->db->get(); 
		return  $query->result_array();

	}

	public function getPermissionList()
	{

		$this->db->select('p.*');
		$this->db->from('m_permission p');	
		$query = $this->db->get(); 
		return  $query->result_array();

	}

	public function getRolePermission($role_id)
	{

		$this->db->select('p.*, rp.permission_id as permission_selected, r.role_name, r.role_desc');
		$this->db->from('m_permission p');
		$this->db->join('role_permissions rp', 'rp.permission_id = p.permission_id  
			 and rp.role_id = '.intval($role_id).'  ', 'left');
		$this->db->join('m_role r', 'r.role_id = rp.role_id ', 'left');
		$this->db->order_by('p.permission_name');
		$query = $this->db->get(); 
		return $query->result_array();
		 

	}
	public function saveRolePermissions($role_id)
	{
		$permissions = $this->getPermissionList();
        
		$input_permissions = $this->input->post('permission_id');
   
        if (!is_array($input_permissions)) {
            $input_permissions = [];
         }
	    //print_r($input_permissions); exit;
		$this->db->trans_start();
  		$this->db->where('role_id', $role_id);
        $this->db->delete('role_permissions'); 

		foreach($permissions as $permission) {
    
			if (in_array($permission['permission_id'], $input_permissions)) {				
				$data = array('role_id'=> $role_id, 'permission_id' =>$permission['permission_id'] );
			    $this->db->insert('role_permissions',$data);
			}

			
		}
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        return false;
		}
		else
		{
		        $this->db->trans_commit();
		         return true;
		}		

	}


}
