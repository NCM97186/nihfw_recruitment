<?php


function get_admin_detail($admin_id) {
       $CI =& get_instance();
        $query = " SELECT  tbl_admin_login.*, m_role.role_name,m_department.department_name,m_designation.designation_name
        FROM  tbl_admin_login
        left join m_role on tbl_admin_login.role_id=m_role.role_id
        left join m_department on  tbl_admin_login.department_id = m_department.department_id
		left join m_designation on  tbl_admin_login.designation_id = m_designation.designation_id 
        where tbl_admin_login.admin_id = '" . $admin_id . "'   ";
        $query = $CI->db->query($query);
        return   $query->row_array();

}

// get all Role list
function get_role_list() {
    $CI =& get_instance();
   $query = "SELECT role_name,role_id FROM m_role";

    $query = $CI->db->query($query);
    $result = $query->result_array();
    $role = array();
     $role[0]='--Select Role--';
    foreach ($result as $row) {
    	 $role[$row['role_id']]= $row['role_name'];
    }
    return $role;
}
function get_advertisement_list() {
    $CI =& get_instance();
   $query = "SELECT adver_title,adver_id FROM advertisement";

    $query = $CI->db->query($query);
    $result = $query->result_array();
    $adver = array();
    //  $adver[0]='--Select Advertisement--';
    foreach ($result as $row) {
    	 $adver[$row['adver_id']]= $row['adver_title'];
    }
    return $adver;
}
function get_cand_profile_status_list() {
    $CI =& get_instance();
   $query = "SELECT status_id,status_name FROM cand_profile_status_master order by status_order";

    $query = $CI->db->query($query);
    $result = $query->result_array();
    $profstatus = array();
     //$profstatus[0]='--Select Profile Status--';
    foreach ($result as $row) {
    	 $profstatus[$row['status_id']]= $row['status_name'];
    }
    return $profstatus;
}



/**
 * Get Current Page
 * @return type
 */

function currentPageURLAdd(){

	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
		$link = "https";
	else
		$link = "http";
	// Here append the common URL characters.
	$link .= "://";
	// Append the host(domain name, ip) to the URL.
	$link .= $_SERVER['HTTP_HOST'];
	// Append the requested resource location to the URL
	$link .= $_SERVER['REQUEST_URI'];
	// Print the link
	//echo $link;die;
    return 'previous='. base64_encode( $link);
}

function previousPageURL(){

    if(isset($_REQUEST['previous'])){
       return base64_decode($_REQUEST['previous']);
    }
    return false;
}

function previousPageInput(){
    if(isset($_REQUEST['previous'])){
       return '<input type="hidden" value="'.$_REQUEST['previous'].'" name="previous" >';
    }
    return false;
}
function previousPageParam(){

   if(isset($_REQUEST['previous'])){
       return 'previous='.$_REQUEST['previous'];
    }
    return false;
}
function my_pagination($total_rows,$per_page,$path){
    $CI =& get_instance();
    $CI->load->library('pagination');
    $config = array();
    $config['enable_query_strings'] = true;
    $config['reuse_query_string'] = true;
    $config['page_query_string'] = TRUE;
    $config['use_page_numbers'] = TRUE;
    $config['query_string_segment'] = 'page';
    $config["base_url"] = base_url() . $path;
    $config["total_rows"] = $total_rows;
    $config["per_page"] = $per_page;
    $config['num_links'] = 5;
    $config['use_page_numbers'] = TRUE;
    //echo "<pre>";print_r($config); die;
    $CI->pagination->initialize($config);
    $links= explode('&nbsp;', $CI->pagination->create_links());
    return $links;
    //echo "<pre>";print_r($links);die;
}

 function cal_diff_in_ymd_format($fromDate,$toDate){
	 $diff = abs(strtotime($toDate)- strtotime($fromDate));
	$years = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	if($years > 0){
	  $years = $years.' Years ';	
	}else { $years = '';}
	if($months > 0){
	 $months = $months.' Months ';	
	}else { $months = '';}
	return $years.$months.$days.' Days';
 }
 
 
 
 function cal_diff_date($maxDate,$minDate,$comDate) {
				$max_date = strtotime($maxDate);
				$min_date = strtotime($minDate);
				$com_date = strtotime($comDate);
				if ($com_date>$max_date){
					return 'max';
				}elseif ($com_date<$min_date) {
					return 'min';
				}else{
				  return true;
				}
	}
function date_convert_normal_to_mysql($dmy){
	//Convert it to YYYY-MM-DD
	$date='';
	if(!empty($dmy)){
		$date = date("Y-m-d",strtotime($dmy));
	}
	return $date;
}


