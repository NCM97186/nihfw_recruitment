<?php

function loadLayout($page = null, $data = null, $type = null) {
    $layout = & get_instance();
    if ($type == 'admin') {
        $layout->load->view('common/header',$data);
		$layout->load->view('common/sidebar',$data);
		$layout->load->view('common/roundheader',$data);
        $layout->load->view($page, $data);
        $layout->load->view('common/footer',$data);
    } else if ($type == 'public') {
        $layout->load->view('common/front_header',$data);
        $layout->load->view($page, $data);
        $layout->load->view('common/front_footer',$data);
    } else if ($type == 'popup') {
        $layout->load->view($page, $data);
      } else {
        $layout->load->view('common/front_header',$data);
        $layout->load->view($page, $data);
        $layout->load->view('common/front_footer',$data);
    }
}

// check if user has permission return true otherwise stop further script execution
function has_admin_permission_layout($permission_name, $type = ''){

	if($type == '' ) {
		$type = 'admin';
	}	
	if(!has_admin_permission($permission_name)) {
		if ($type == 'admin') {
		  loadLayout('common/admin_permission_denied', null , $type);
		}
		if ($type == 'popup') {
		  loadLayout('common/admin_permission_denied', null , $type); 
		}
		
		 return false;
    }	
    return true;
 
}
/*** To get actual Ip address */
if (!function_exists('actual_ip')) {
    function actual_ip(){
		$ipaddress = '';
        if(array_key_exists('HTTP_CLIENT_IP', $_SERVER))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        elseif(array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        elseif(array_key_exists('HTTP_X_FORWARDED', $_SERVER))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        elseif(array_key_exists('HTTP_FORWARDED_FOR', $_SERVER))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        elseif(array_key_exists('HTTP_FORWARDED', $_SERVER))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        elseif(array_key_exists('REMOTE_ADDR', $_SERVER))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress ;
	}
}
function pr($data){
		echo  "<pre>";
		$pr = print_r($data);
		return $pr;
	}
	
if(!function_exists('audit_trail'))
{
	function audit_trail( $data_array = array() )
	{
		$CI = get_instance();
		$CI->load->model('Audit_model', '', true);
		
		$whEre 	= array('user_login_id'     => isset($data_array['user_login_id'])?$data_array['user_login_id']:'',
                                'page_id'           => isset($data_array['page_id'])?$data_array['page_id']:0,
                                'page_name'         => isset($data_array['page_name'])?$data_array['page_name']:'',
                                'page_action'       => isset($data_array['page_action'])?$data_array['page_action']:'',
                                'page_category'     => isset($data_array['page_category'])?$data_array['page_category']:'',
                                'page_action_date'  => date('Y-m-d h:i:s'),
                                'ip_address'        => $_SERVER['REMOTE_ADDR'],
                                'lang'              => isset($data_array['lang'])?$data_array['lang']:1,
                                'page_title'        => isset($data_array['page_title'])?$data_array['page_title']:'',
                                'approve_status'    => isset($data_array['approve_status'])?$data_array['approve_status']:1,
                                'usertype'          => isset($data_array['usertype'])?$data_array['usertype']:''
                                    );
		
		$numRows = $CI->Audit_model->save($whEre);
		return $numRows;
	}
}


// if ( ! function_exists('check_cookies'))
// {
// 	function check_cookies(){
		
//              // echo "salt-----".$_SESSION['saltCookie'];
//         //     echo "<br>";
//         //     echo "cookies-temp----".$_COOKIE['Temp'];
//         //     echo "<br>";
//         //     echo "cookies-temptest----".$_SESSION['Temptest'];
// 		// die();

// 		if ($_SESSION['saltCookie'] != $_COOKIE['Temp']) {
// 			$message    = "Login to Access Admin Panel";
//             //$this->session->set_flashdata('message', $message);
//             redirect(base_url('login'));
// 		}
// 		else{
//             $_COOKIE['Temp']="";
//             $_SESSION['saltCookie']="";
//             $_SESSION['Temptest']="";
//             $saltCookie =uniqid(rand(59999, 199999));
//             $_SESSION['saltCookie'] =$saltCookie;
//             $_SESSION['Temptest']=$_SESSION['saltCookie'];
//             $_COOKIE['Temp']=$_SESSION['saltCookie'];
//             $_SESSION['logtoken'] =md5(uniqid(mt_rand(), true));   
// 			}

//         //     echo "salt-----".$_SESSION['saltCookie'];
//         //     echo "<br>";
//         //     echo "cookies-temp----".$_COOKIE['Temp'];
//         //     //print_r(session_get_cookie_params());
//         //     echo "<br>";
//         //     echo "cookies-temptest----".$_SESSION['Temptest'];
// 		// die();  
//     }
// }
if ( ! function_exists('age_calculate')){

     function age_calculate( $date, $month, $years){

            $dobdate = (int) !empty($date)?$date:0;
            $dobmonth = (int) !empty($month)?$month:0; 
            $dobyear = (int) !empty($years)?$years:0; 
            $currentmonth =  $month = date('m');
            $calculated_days=0;
            if($dobdate>1){
                $calculated_days = 31-$dobdate;
                $dobmonth = $dobmonth+1;
            }
            if($dobmonth<=6){
                $calculated_month = 6-$dobmonth;
            }else{
                $calculated_month = 18-$dobmonth;
                $dobyear = $dobyear+1;
            }
            if($currentmonth <= 7){
                $yyyy = (int)date('Y');             
            }else{
                $yyyy =  !empty($dobyear)?((int)date('Y')):0;    

            }
            $calculated_month= !empty($dobyear)?($calculated_month):0;
            $dob_age ='';
            $last_date = '01-07-'.$yyyy; 
            $calculated_year = $yyyy-$dobyear;
            $dob_age = $calculated_year;
            $dob_age .= $calculated_year>1?' Years ':' Year ';
            $dob_age .=$calculated_month;
            $dob_age .= $calculated_month>1?' Months ':' Month ';
            $dob_age .=$calculated_days;
            $dob_age .= $calculated_days>1?' Days':' Day';
            return $dob_age ;
    }
}