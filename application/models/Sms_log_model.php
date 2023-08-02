<?php defined('BASEPATH') or exit('No direct script access allowed');
class Sms_log_model extends CI_Model{
	
	function __construct()
	{
		// call the model constructor
		parent::__construct();
	}

    private function save_log($mobile,$email,$msg,$action = 'INSERT'){
      if($action == 'INSERT'){
        $params['mobile'] = $mobile;
        $params['email'] = $email;
        $params['msg'] = $msg;
        $params['USER_IP'] =  actual_ip();
        $params['USER_AGENT'] =  $_SERVER['HTTP_USER_AGENT'];
        $params['SESSION_ID'] = session_id();
        $params['REFERRER'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '' ;
        $params['URL'] = $this->uri->uri_string();
        $admin_login_log_id = $this->add_user_sms_log($params);
       }
    }
    
    /*
     * Get all user_sms_log
     */
    function get_all_user_sms_log(){
        $this->db->order_by('id', 'desc');
        return $this->db->get('user_sms_log')->result_array();
    }
        
    /*
     * function to add new user_sms_log
     */
    function add_user_sms_log($param){	
		foreach($param as $key => $val){			
			$param[$key] = $val;						
		}
        $this->db->insert('user_sms_log',$param);
        return $this->db->insert_id();
    }
    
    /*
     * function to update user_sms_log
     */
    function update_user_sms_log($params,$where)
    {
        $this->db->where($where);
        return $this->db->update('user_sms_log',$params);
		//echo $this->db->last_query();
    }

    function add_user_login_log($param){
        foreach($param as $key => $val){            
            $param[$key] = $val;                        
        }
        $this->db->insert('user_login_log',$param);
        return $this->db->insert_id();
    }
    function update_user_login_log($params,$where){
        $this->db->where($where);
        return $this->db->update('user_login_log',$params);
    }
    
    /*
     * function to delete user_sms_log
     */
    /*function delete_user_sms_log($id)
    {
        return $this->db->delete('user_sms_log',array('id'=>$id));
    }*/
}