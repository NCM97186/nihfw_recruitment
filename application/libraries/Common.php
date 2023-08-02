<?php
class Common{
    var $date_time;
    var $date;
    var $meta_title;
    var $meta_keyword;
    var $meta_description;
    var $tagline;
    var $destination;
    function __construct(){
		date_default_timezone_set('Asia/Kolkata');
		$CI	=& get_instance();
		$CI->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $CI->output->set_header("Pragma: no-cache");
        $this->date_time =   date("Y-m-d H:i:s");
        $this->date     =   date("Y-m-d");
        //$this->getseo();
	}
 
    private function emailconfig(){
        $config = Array(
            'mailtype' => 'html',
			'charset' => 'utf-8',
			'validate' => TRUE,
			'wordwrap' => TRUE,
			'priority' => 3
        );
        return $config;
    }
	public function getadmindetails($admin_id){
		$CI	=& get_instance();
		$sql	=	$CI->db->query("select * from `tbl_admin_login` where admin_id='".$admin_id."' and status='1'");
		if($sql->num_rows()==0){
			redirect(base_url()."logout");
		}else{
			return $sql->row_array();
		}
	}
    function __check_session(){
        $CI	=& get_instance();
        $CI->load->model('loginmodel');
        $session_values 	=	$CI->session->userdata('ADMIN');
        if(!isset($session_values['admin_id']) || $session_values['admin_id']==''){
            if(!$CI->loginmodel->remember_me_check()){
               redirect(base_url().'logout');
            }
               
        }else{
            return $this->getadmindetails($session_values['admin_id']);
        }
    }
    /*User session check */
    public function getuserdetails($user_id){
        $CI =& get_instance();
        $sql    =   $CI->db->query("select * from users where user_id='".$user_id."'");
        if($sql->num_rows()==0){
            redirect(base_url()."/");
        }else{
            return $sql->row_array();
        }
    }
    function __check_user_session(){
        $CI =& get_instance();
        $CI->load->model('Users_model');
        $session_values     =   $CI->session->userdata('USER');
        if(!isset($session_values['user_id']) || $session_values['user_id']==''){
               redirect(base_url().'/');
               
        }else{
            return $this->getuserdetails($session_values['user_id']);
        }
    }
    function sendregistrationmail($id){
        $CI	    =&  get_instance();
        $sql	=	$CI->db->query("select * from `tbl_login` where id='".$id."'");
        $row    =   $sql->row_array();
        if(!empty($row)){
            $tpl_sql    =   $CI->db->query("select * from `tbl_email_template` where `for`='0'");
            $tpl_row    =   $tpl_sql->row_array();
            $tpl_msg    =   $tpl_row['desc'];
            $message_array  =   array(
                "[[user_name]]" =>  $row['name'],
                "[[email]]" =>  $row['email'],
            );
            $message    =	str_replace(array_keys($message_array), array_values($message_array), $tpl_msg);
            $config 	=   $this->emailconfig();
            $CI->load->library('email', $config);
            $CI->email->initialize($config);
            $CI->email->set_newline("\r\n");
            $CI->email->from('register@gocompany.in',"GoCompany"); // change it to yours
            $CI->email->to($row['email']);// change it to yours
            $CI->email->subject($tpl_row['subject']);
            $CI->email->message($message);
            if($CI->email->send()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    function getuserinfo($tbl_name,$id){
        $CI =& get_instance();
        $sql = $CI->db->query("select * from `".$tbl_name."` where 1 and id='".$id."'");
        if($sql->num_rows()!=0){
            return $sql->row_array();
        }
    }
    function delete($tbl_name,$id,$field){
        $CI =& get_instance();
        //echo "select * from `".$tbl_name."` where id='".$id."'";die;
        $sql    =   $CI->db->query("select * from `".$tbl_name."` where id='".$id."'");
        $all    =    $sql->row_array();
        $image  =   $all[$field];
       
        unlink($image);
    }
    function deleteImage($tbl_name,$id,$field,$path){
        $CI =& get_instance();
        //echo "select * from `".$tbl_name."` where id='".$id."'";die;
        $sql    =   $CI->db->query("select * from `".$tbl_name."` where id='".$id."'");
        $all    =    $sql->row_array();
        $image =FCPATH.$path.$all['image'];       
        if(unlink($image))
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }
function deleteDoc($tbl_name,$id,$field,$path){
        $CI =& get_instance();
        //echo ("select * from `".$tbl_name."` where id='".$id."'");die;
        $sql    =   $CI->db->query("select * from `".$tbl_name."` where id='".$id."'");
        $all    =    $sql->row_array();
        $image =FCPATH.$path.$all['document'];      
        if(unlink($image))
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }
	

	
}