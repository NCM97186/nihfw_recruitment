
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class loginmodel extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->library('encryption');
    }
   
    public function getlogin($username, $password)
    {   
        $this->db->select('*');
        $this->db->from('tbl_admin_login');
        $this->db->where($username);
        $res = $this->db->get()->row_array();
        $pass= $res['password'].$_SESSION['salt'];
        $dbpass   = strtoupper($pass);
        $postpass = $password;
        if($dbpass != ''){
        if($dbpass == $password)
        {
                $update_array   =   array(
                         "last_login"    =>  $res['login'],
                         "login"         =>  date("Y-m-d H:i:s")
                 );   
                 $this->db->update("tbl_admin_login",$update_array);
                 $this->db->where("admin_id",$res['admin_id']);
                 $this->setUserLoginSession($res);
                 return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
  
    }
    public function setUserLoginSession($row){

        $session_array = array(
            'admin_id' => $row['admin_id'],
            'role_id' => $row['role_id']
        );

        $this->session->set_userdata('ADMIN', $session_array);
        return true;
    }

    public function mysettings($id){
        $this->db->select('*');
        $this->db->from('tbl_admin_login');
        $this->db->where('id = ' . "'" .intval( $id). "'");
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return false;
        }
    }
    public function updateinfo($data,$id,$tbl_name){
        $this->db->where('id', $id);
        $this->db->update($tbl_name ,$data);
        return true;
    }

    public function remember_enter($admin_id){        
       
        $row = $this->common->getadmindetails($admin_id);
        if($row){

            $data = array(
                'admin_id' => $row['admin_id'],
                'match_hash' => md5($row['admin_id'].'_'.$row['password']),  
           );
            $this->db->insert('admin_remember',$data);
            $n = $this->db->insert_id();
            setcookie('remember_me',
              $this->encryption->encrypt($n.','.date("Y-m-d H:i:s")),time()+ (2629746),'/','','',TRUE);
            return true;
        }
        return false;          
               
    }
	public function get_login_data($username)
	{
		$this->db->select('*');
		$this->db->from('tbl_admin_login');
		$this->db->where('username', $username);
		$query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return false;
        }
	}
   
    public function remember_me_check(){
        
        $this->load->helper('cookie');

        $encrypted_remember_me = isset($_COOKIE['remember_me'])? $_COOKIE['remember_me']: '';
        $remember_me = $this->encryption->decrypt($encrypted_remember_me);
       
        if(!$remember_me) {            
            return false;        
        }
        $remember_id = substr($remember_me, 0, strpos($remember_me,',')+1);

        if(isset($remember_id) && $remember_id != '') {
            $this->db->where('remember_id',$remember_id);
            $query=$this->db->get('admin_remember');
            $remember_row= $query->row();
            if($query->num_rows()>0){
                $user_record = $this->common->getadmindetails($remember_row->admin_id);              
            }
        } 

        if(!isset( $user_record)) {
            return false;
        }
        if( $remember_row->match_hash != 
         md5($user_record['admin_id'].'_'.$user_record['password'])){
            return false;
         }
         $this->setUserLoginSession($user_record);
         return true;
       
    }	


    public function view($where=array())
	{
		if(count($where)>0)
		{
			foreach($where as $key=>$val)
			$this->db->where($key, $val);
		}

		// $this->db->order_by('user_type');
		$query = $this->db->get('tbl_admin_login');
		return $query->result_array();
	}
    public function save($id,$pass)
	{
        $this->db->from('tbl_admin_login');
		$this->db->where('admin_id', $id);
		$this->db->update('tbl_admin_login',$pass);
		return $id;
	}
    public function view_single($where=array())
	{
		if(count($where)>0)
		{
			foreach($where as $key=>$val)
			$this->db->where($key, $val);
		}

		$query = $this->db->get('tbl_admin_login');
		
		return $query->row_array();
	}
	public function updateflag($data,$where){
        $this->db->where($where);
        $this->db->update('tbl_admin_login',$data);
        return true;
    }
    public function pwdhistory($where)
    {
        $this->db->from('admin_pwdhistory');
		$this->db->where($where);
		$result = $this->db->get()->row();
        return $result;
		
    }
    public function save_history($data)
    {
		$res= $this->db->insert('admin_pwdhistory',$data);
		return $res;
    }
}
?>