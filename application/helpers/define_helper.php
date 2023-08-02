<?php


global $USER_ROLES, $USER_PERMISSIONS, $USER_ROLES_PERMISSIONS, $ALLOWED_ENTRY_SETTINGS, $USER_UPLOAD_PATH;

$USER_ROLES = getADMIN_ROLES();

$USER_PERMISSIONS = getADMIN_TotalPermissions();

$USER_ROLES_PERMISSIONS = getADMIN_ROLES_PERMISSIONS();
$USER_UPLOAD_PATH = 'uploads/user/';



function getADMIN_ROLES()
    {
        $CI =& get_instance();
        $CI->load->database();
        $CI->db->select('m_role.role_id, m_role.role_name');      
        $CI->db->from('m_role');
        $query =  $CI->db->get(); 
        $roles = array();
        foreach ($query->result() as $row)
        {    
             $roles[$row->role_id] = $row->role_name;              
        }
        return $roles;
    }

    function getADMIN_TotalPermissions()
    {
        $CI =& get_instance();
        $CI->load->database();
        $CI->db->select('m_permission.permission_name, m_permission.permission_description');      
        $CI->db->from('m_permission');
        $query =  $CI->db->get(); 
        $permission = array();
        foreach ($query->result() as $row)
        {    
             $permission[$row->permission_name] = $row->permission_description;              
        }
        return $permission;
    }


function getADMIN_ROLES_PERMISSIONS()
    {
        $CI =& get_instance();
        $CI->load->database();
        
        $CI->db->select('rp.role_id, rp.permission_id, p.permission_name');
        $CI->db->from('role_permissions rp');
        $CI->db->join('m_permission p', 'rp.permission_id = p.permission_id', 'left');
        $CI->db->order_by('rp.role_id','asc');        
        $query = $CI->db->get(); 
        $role_permissions = array();
        foreach ($query->result() as $row)
        {    
             $role_permissions[$row->role_id][] = $row->permission_name;              
        }
        return $role_permissions;
         
    }
// check if user has permission
function has_admin_permission($permission_name){

    global $USER_PERMISSIONS;
    global $USER_ROLES_PERMISSIONS ;
 

    if(!isset($_SESSION['ADMIN']['role_id'])) {       
        return false;
    }

    $role_id = $_SESSION['ADMIN']['role_id'];
    if(!isset($USER_PERMISSIONS[$permission_name])) {        
        return false;
    }  
    if(!isset($USER_ROLES_PERMISSIONS[$role_id])) {        
        return false;
    } 
    if(!in_array($permission_name, $USER_ROLES_PERMISSIONS[$role_id])) {
         
        return false;
    }

    return true;

}