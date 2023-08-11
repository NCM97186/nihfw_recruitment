<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('Users_model','users'); 
        $this->load->library('session');
		$this->load->library('email');
        $this->load->helper('captcha');
        $this->load->helper('cookie');
		$this->load->helper('string');
		$this->load->model('Notifications_model');
		$this->generateSalt();
    }
    public function index()
	{
	
	  $data = null;
	  $data['result']=$this->Notifications_model->get_jobPost();
	  // Pass captcha image to view
        // if($this->config->item('captcha_enabled')){
            $data['captcha'] =  $this->captcha();
		// }
		// print_r($data['captcha']);
		// die();
	  loadLayout('user/index', $data);

	}
	
	public function getlogin(){
        $data = null;
		$sessCaptcha = $this->session->userdata('captchaCode');
         $data['result']=$this->Notifications_model->get_list();
        if($this->input->post('login')) {
			    //$this->session->set_userdata('captcha_answer',$this->input->post('code'));

				$this->form_validation->set_rules('cand_mob', 'Mobile', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
	            $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required');
	                //$data['captcha'] =  $this->captcha();
				if($this->form_validation->run() != FALSE ){
					
					if($this->input->post('captcha') != $this->session->userdata('captchaCode')){
						$this->session->set_flashdata('message', 'Captcha incorrect');
					}else{
					 $credentials  =   array(
			            "cand_mob"=>$this->input->post('cand_mob'),
						"registration_number"=>$this->input->post('cand_mob'),
			            "password"=>  strtoupper($this->input->post('password'))
			        );
					
			        $user = $this->users->getlogin($credentials);
					if($user){
						//$this->session->set_flashdata('success', 'Login Successfully Done');
						redirect('dashboard/UserDashboard');
					}else{
						$this->session->set_flashdata('message', 'Invalid Login Details'); 
						redirect(base_url());
				    }
				}
			}
				
            }
            
        // if($this->config->item('captcha_enabled')){
                $data['captcha'] =  $this->captcha();
        // }
        loadLayout('user/index', $data);
    }

	// public function getUserlogin(){
    //     $data = null;
		
    //      $data['result']=$this->Notifications_model->get_list();
    //     if($this->input->post('login')) {
	// 		    $this->session->set_userdata('captcha_answer',$this->input->post('code'));

	// 			$this->form_validation->set_rules('cand_mob', 'Mobile', 'trim|required');
	// 			$this->form_validation->set_rules('password', 'Password', 'trim|required');
				
    //             if($this->config->item('captcha_enabled')){
	//                 $this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_check_captcha');
	//                }  
	// 			if($this->form_validation->run() != FALSE ){
					
	// 				 $credentials      =   array(
	// 		            "cand_mob"=>$this->input->post('cand_mob'),
	// 					"registration_number"=>$this->input->post('cand_mob'),
	// 		            "password"=>strtoupper($this->input->post('password'))
	// 		        );

	// 				//print_r($credentials);die;
					
	// 		        $user = $this->users->getlogin($credentials);
	// 				//print_r($user);die;
	// 				if($user){
	// 					$this->session->set_flashdata('success', 'Login Successfully Done');
	// 					redirect('dashboard/basicInfo');
	// 				}else{
	// 					$this->session->set_flashdata('message', 'Invalid Login Details'); 
	// 					redirect(base_url());
	// 			    }
	// 			}
				
    //         }
            
    //     if($this->config->item('captcha_enabled')){
    //             $data['captcha'] =  $this->captcha();
    //     }
    //     loadLayout('user/index', $data);
    // }
	//  public function login()
	// 	{
			
	// 	  $data = null;
	// 	  $data['result']=$this->Notifications_model->get_list();
    //     if($this->input->post('login')) {
	// 		    $this->session->set_userdata('captcha_answer',$this->input->post('code'));

	// 			$this->form_validation->set_rules('cand_reg', 'Mobile', 'trim|required');
	// 			$this->form_validation->set_rules('password', 'Password', 'trim|required');
				
    //             // if($this->config->item('captcha_enabled')){
	//                 $this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_check_captcha');
	//             //    }  
 
	                 
	// 			if($this->form_validation->run() != FALSE ){

	// 				 $credentials      =   array(
	// 		            // "cand_mob"=>$this->input->post('cand_mob'),
	// 					"registration_number"=>$this->input->post('cand_reg'),
	// 		            "password"=>md5($this->input->post('password'))
	// 		        );
	// 				// print_r($credentials);
	// 				// die();
	// 		        $user = $this->users->getlogin($credentials);
	// 				if($user){
	// 					$this->session->set_flashdata('success', 'Login Successfully Done');
	// 					redirect('dashboard/basicinfo');
	// 				}else{
	// 					$this->session->set_flashdata('message', 'Invalid Login Details'); 
	// 					redirect(base_url());
	// 			    }
	// 			}
				
    //         }
    //         if($this->input->post('register')) {
    //         	$post_val = $this->input->post();
	// 		    $this->session->set_userdata('captcha_answer',$this->input->post('code'));
	// 			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
	// 			$this->form_validation->set_rules('last_name', 'last name', 'trim|required');
	// 			$this->form_validation->set_rules('reg_cand_mob', 'Mobile', 'trim|required|is_unique[users.cand_mob]',array('is_unique' => 'The Mobile is already exist'));
	// 			$this->form_validation->set_rules('reg_cand_email', 'Email', 'trim|required|valid_email|is_unique[users.cand_email]',array('is_unique' => 'The Email is already exist'));
    //             if($this->config->item('captcha_enabled')){
	//                 $this->form_validation->set_rules('reg_captcha', 'Captcha', 'required|callback_check_captcha');
	//                }  
			  
	// 			if($this->form_validation->run() != FALSE ){
					
	// 				$password = random_string( 'numeric', 5 );
	// 				$data_user = array(
	// 					'first_name' => $post_val['first_name'],
	// 					'middel_name' => $post_val['middel_name'],
	// 					'last_name' => $post_val['last_name'],
	// 					'cand_mob' => empty($post_val['reg_cand_mob']) ? NULL : intval($post_val['reg_cand_mob']),
	// 					'cand_email' => $post_val['reg_cand_email'],
	// 					'password' => md5($password)
	// 					);	
	// 				$this->users->insert_update($data_user);
	// 				$this->session->set_flashdata('success', 'Data saved Successfully. An Password has send to your mobile no kindly verify it');
					
	// 				//$_SESSION['user_otp'] = $otp;
	// 				$mobile=$post_val['reg_cand_mob'];
	// 				$email=$post_val['reg_cand_email'];
	// 				$msg='Successfully Registrar';
					
	// 				// $this->sendOTP($mobile, $password );
	// 				$this->save_log($mobile,$email,$msg,'INSERT');
	// 				redirect('user');
	// 			}
				
    //         }
	// 	  // Pass captcha image to view
	//         if($this->config->item('captcha_enabled')){
	//             $data['captcha'] =  $this->captcha();
	// 		}
	// 	  loadLayout('user/login', $data);

	// 	}
	
	public function registration()
	{
	    $data = null;
		
	    if($this->input->post('register')) {
			//$this->session->set_userdata('captcha_answer',$this->input->post('code'));
			
				$where= array('cand_mob' => $this->input->post('cand_mob'), 'verified' => 0);
				$res= $this->db->select('*')->from('users')->where($where)->get()->row();
				
				if($res){
					if($this->input->post('captcha') != $this->session->userdata('captchaCode')){
						$this->session->set_flashdata('error', 'Captcha incorrect');
						redirect('user/registration');
					}
						$registration_number = $res->registration_number;
						$mobile = $res->cand_mob;
						$password = random_string( 'numeric', 5 );
						$otp = rand(100000, 999999);
						$senderid = 1107168173127410352;
						$smscurl = 'http://117.239.183.111/SMSSend/sendSmsNormal?';
						$cid = 413;
						$this->db->where('user_id',$res->user_id)->update('users',array('otp' => $otp,'currenttime'=>$_SERVER["REQUEST_TIME"]));
						$this->session->set_userdata('cand_mobile', $mobile);
						$this->sendOTP($cid,$mobile, $otp,$registration_number,$senderid,$smscurl );
						$this->session->set_flashdata('success', 'Registration Successfully. An otp  has send to your mobile No. Plz verify to login. ');
						redirect('verify');
				
				}else{
		
			    
				$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
				// $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('cand_mob', 'Mobile No.', 'trim|required|is_unique[users.cand_mob]',array('is_unique' => 'This Mobile Number is already exist'));
				$this->form_validation->set_rules('cand_email', 'E-mail ID', 'trim|required|valid_email|is_unique[users.cand_email]',array('is_unique' => 'The Email is already exist'));
	            $this->form_validation->set_rules('captcha', 'Captcha', 'required'); 
			  
				if($this->form_validation->run() != FALSE ){
						
					if($this->input->post('captcha') != $this->session->userdata('captchaCode')){
						
						$this->session->set_flashdata('error', 'Captcha incorrect');
						redirect('user/registration');
					}else{
					$post_val = $this->input->post();
					
					$password = random_string( 'numeric', 5 );
					$otp = rand(100000, 999999);
					$data_user = array(
						'first_name' => $post_val['first_name'],
						'middel_name' => $post_val['middel_name'],
						'last_name' => $post_val['last_name'],
						'cand_mob' => empty($post_val['cand_mob']) ? NULL : intval($post_val['cand_mob']),
						'cand_email' => $post_val['cand_email'],
						'password' => hash("sha512", $password),
						'otp'=>$otp,
						'currenttime'=>$_SERVER["REQUEST_TIME"],
						'temppass'=>$password
						);
					
						$registration_number=$this->users->insert_update($data_user);
						$senderid = 1107168173127410352;
						$mobile = $data_user['cand_mob'];
						$smscurl = 'http://117.239.183.111/SMSSend/sendSmsNormal?';
						$cid = 413;
						//$otp = rand(100000, 999999);
						$this->session->set_userdata('cand_mobile', $post_val['cand_mob']);
						$this->sendOTP($cid,$mobile, $otp,$registration_number,$senderid,$smscurl );
						$this->session->set_flashdata('success', 'Registration Successfully. An otp  has send to your mobile No. Plz verify to login. ');
						
					//$_SESSION['user_otp'] = $otp;
					// $mobile=$post_val['cand_mob'];
					// $email=$post_val['cand_email'];
					// $msg='Successfully Registrar';
					// $message='Hi '.$post_val['first_name'].',
					// Your Registration Number: '.$registration_number.'
					// Password: '.$password;					
					// //$this->send_sms($mobile,$message);
					// $to=$post_val['cand_email'];
					// $from="rajeshk@nihfw.org";
					//$this->SendCustomEmail($to,$from,$message);
					//$this->sendOTP($mobile, $password );
					// $this->save_log($mobile,$email,$msg,'INSERT');
					
					redirect('verify');
				}
			}
				
            }
		}
            
        // Pass captcha image to view
        // if($this->config->item('captcha_enabled')){
            $data['captcha'] =  $this->captcha();
		// }
	  loadLayout('user/registration', $data);
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
        $this->load->model('Sms_log_model');
        $admin_login_log_id = $this->Sms_log_model->add_user_sms_log($params);
       }
    }
	
	public function check_captcha($string)
		{
		   if($string != $this->session->userdata('captchaCode')):
		      $this->form_validation->set_message('check_captcha', 'captcha incorrect');
		      return false;
		   else:
		      return true; 
		   endif;
		}
		
	function send_sms($contact="",$body="")
    {
      $url = "https://mh.nhp.org.in/newsendsms.php";
      $post = array(
                      'campaign_id' => '100074',
                      'cid' => '6862',
                      'params' => '{"<text>":"'.$body.'"}',
                      'mobile' => ''.$contact.'',
                      'sender_id' => 'NHPSMS'
                    );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        if(!empty($post))
        {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        } 
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
	
    private function captcha(){
      
        $config = array(
            'img_path'      => './captcha/',
            'img_url'       => base_url().'/captcha/',
           
            'font_path'     => realpath('system/fonts/texb.ttf'),
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 6,
            'font_size'     => 18,
            'pool' => '23456789ABCDEFGHJKLMNPQRSTUVWXYZ',
            'colors'        => array(
                'background' => array(16, 56, 135),
                'border' => array(9, 48, 176),
                'text' => array(255, 255, 255),
                'grid' => array(81, 108, 164)
                )
        );
        $captcha = create_captcha($config);
	
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        

        return $captcha;
    }

	public function SendCustomEmail($to,$from,$message){
		$this->email->from($from, 'NIHFW');
			$this->email->to($to);
			 
			$this->email->subject('NIHFW');
			$this->email->message($message);
            $this->email->send();
	}
    function refresh_captcha(){
        $captcha =  $this->captcha();
		$this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        echo  $captcha['image'];
		// die();
    }
    /**
     * Callback function. Check if CAPTCHA test is passed.
     *
     * @param    string
     * @return    bool
     */
    function logout(){
        if(isset($_COOKIE['remember_me'])){
            setcookie('remember_me', '', time()-7000000, '/');
        }
        $this->session->sess_destroy();
         redirect(base_url('user'));
    } 
	
	function forgotPassword(){
		$data = null;
		 if($this->input->post()) {
			 if(!empty($this->input->post('cand_mob'))&&empty($this->input->post('registration_id'))){
				$this->form_validation->set_rules('cand_mob', 'Mobile', 'trim|required|callback_forgetmobile');
			//  }elseif(empty($this->input->post('cand_mob'))&&!empty($this->input->post('registration_id'))){
			// 	$this->form_validation->set_rules('registration_id', 'Registration Number', 'trim|required|callback_forgetid');
			 }else{
				 $this->form_validation->set_rules('cand_mob', 'Mobile', 'required');
				//  $this->form_validation->set_rules('registration_id', 'Registration Number', 'required');
			 }
				 
			if($this->form_validation->run() != FALSE ){
				
				$post_val = $this->input->post();
				$password = random_string( 'numeric', 5 );
				$candmob = $post_val['cand_mob'];
				$regnumber = $post_val['id'];
				if(!empty($regnumber)){
					
					$userdata = $this->db->select('*')->from('users')->where('registration_number', $regnumber)->where('cand_mob', $candmob)->get();
					//$query = $this->db->get();

					if ( $userdata->num_rows() > 0 )
					{
						$row = $userdata->row_array();
						$mobile=$post_val['cand_mob'];
						$email=$mobile;
						$msg='Forget Password';
						$message='Hi,
						Your updated Password: '.$password;					
						//$this->send_sms($mobile,$message);
						$senderid = 1107168187177299332;
						$smscurl = 'http://117.239.183.111/SMSSend/sendSmsOTP?';
						$cid = 415;
						$this->session->set_userdata('fotp', $password);
						$this->session->set_userdata('registration_number', $post_val['id']);
						$this->session->set_userdata('otp_sendtime', $_SERVER["REQUEST_TIME"]);
						$this->session->set_userdata('cand_mob', $mobile);

						$this->sendOTP($cid,$mobile, $password,$post_val['registration_id'],$senderid,$smscurl );
						$to="rajeshk@nihfw.org";
						$from="rajeshk@nihfw.org";
						$this->SendCustomEmail($to,$from,$message);
						//$this->save_log($mobile,$email,$msg,'INSERT');
						$this->session->set_flashdata('success', 'An otp has send to your mobile No. Plz verify ');
						redirect('Resetpass');
						
					}else{
						
						$this->session->set_flashdata('error', 'We have not find your detail in our records. Please check your registration number or mobile number');
						redirect('user/forgotPassword');
					}
					
				
				}else{
					$userdata = $this->db->select('*')->from('users')->where('cand_mob', $candmob)->get();

					if ( $userdata->num_rows() > 0 )
					{
						$row = $userdata->row_array();
						$mobile=$post_val['cand_mob'];
						$email=$mobile;
						$msg='Forget Password';
						$message='Hi,
						Your updated Password: '.$password;					
						//$this->send_sms($mobile,$message);
						$senderid = 1107168187177299332;
						$smscurl = 'http://117.239.183.111/SMSSend/sendSmsOTP?';
						$cid = 415;
						$this->session->set_userdata('fotp', $password);
						$this->session->set_userdata('registration_number', $post_val['id']);
						$this->session->set_userdata('otp_sendtime', $_SERVER["REQUEST_TIME"]);
						$this->session->set_userdata('cand_mob', $mobile);

						$this->sendOTP($cid,$mobile, $password,$post_val['registration_id'],$senderid,$smscurl );
						$to="rajeshk@nihfw.org";
						$from="rajeshk@nihfw.org";
						$this->SendCustomEmail($to,$from,$message);
						//$this->save_log($mobile,$email,$msg,'INSERT');
						$this->session->set_flashdata('success', 'An otp has send to your mobile No. Plz verify ');
						redirect('Resetpass');
					}
					
				}
			}
				
				
				
				
				
			
			
		}
	  loadLayout('user/forgotPassword', $data);
} 

function ChangePassword(){
	loadLayout('user/changepass');
}
	
	function forgetmobile($input)
	{
		$mobilecheck=$this->users->checkMobile($input); 
		if ($mobilecheck)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('forgetmobile', 'Mobile Number not exist');
			return FALSE;        
		}
	}
	function forgetid($input)
	{
		$mobilecheck=$this->users->checkid($input); 
		if ($mobilecheck)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('forgetid', 'Registration Number not exist');
			return FALSE;        
		}
	}

	public function sendOTP( $cid,$mobile, $otp,$username,$senderid,$smscurl ) {
				
		$postDataArray = [
			"campaign_id"=>1000016,
			"cid"=>$cid,
			"parm"=>'{"<username>":"user","<otp>":"'.$otp.'"}',
			"mobile"=>$mobile,
			"sender_id"=>$senderid,
			"OtherApplicationRequestTime"=>date('m/d/Y H:i:s')
		];
		//print_r($postDataArray);
		$data = http_build_query($postDataArray);
		//echo $data;
		 
		$url = $smscurl.$data;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 80);
		   
		$response = curl_exec($ch);
			
		if(curl_error($ch)){
			echo 'Request Error:' . curl_error($ch);
		}else{
			echo $response;
		}
		   
		curl_close($ch);
	//die;
	//    echo json_encode( $data );
}

public function generateSalt() {

	 $salt = isset($_SESSION['salt']) ? $_SESSION['salt'] : '';
	if($salt == ""){
		$salt =uniqid(rand(59999, 199999));
		$saltCookie =uniqid(rand(59999, 199999));
		$_SESSION['salt']=$salt;
		$_SESSION['saltCookie'] =$saltCookie;
		//  echo $saltCookie;
	}
}

public function changePasswordProcess()
	{
		
		$data  = array();
		
		$_POST = $this->security->xss_clean($this->input->post());
		

		foreach($_POST as $postKey => $postValue)
		{
			$_POST[$postKey] 	= $postValue;
			$data[$postKey] 	= $postValue;
		}

		//validation
		$this->load->library('form_validation');
                $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
                $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
                $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				loadLayout('user/changepass', $data);
		}
		else
		{
                    
                    
					$this->db->where('user_id',$_SESSION['USER']['user_id']);
					$query=$this->db->get('users');
					$result=$query->result();
				
                   
					
					$postoldpass = hash("sha512", $_POST['old_password']);
					
				
					
                    
						
						
						if($_POST['new_password'] != $_POST['confirm_password'])
						{
							//error confirm password is not matched with new password
							$this->session->set_flashdata('error', '<span style="color:white;">Confirm new password not match.</span>');
							redirect(site_url('user/ChangePassword'));
						}else{
							$dataArr = array(); 
							$dataArr = $this->input->post();  
							$pArray = array();
							//$pArray['password']   = hash("sha512", $_POST['new_password']);
							$updateddata = array('password' => hash('sha512',$_POST['new_password']));    
							$this->db->where('user_id', $_SESSION['USER']['user_id']);
							$this->db->update('users', $updateddata);
							$this->session->set_flashdata('success', '<span style="color:green;">Password changed.</span>');
							redirect(site_url('user/ChangePassword'));

						}

						if($_POST['new_password']==''){
							unset($_POST['new_password']);
						}
                       
					
			

		}
	}
	public function Dashboard()
	{
		$this->user_info     =  $this->common->__check_user_session();

		$data = null;
		$user_id = $_SESSION['USER']['user_id'];
		if ($this->input->post('basicinfo')) {
			$post_val = $this->input->post();
			$update_array = array(
				'first_name' => $post_val['first_name'],
				'middel_name' => $post_val['middel_name'],
				'last_name' => $post_val['last_name']
			);
			$this->db->where("user_id", $user_id);
			$this->db->update("users", $update_array);
			$this->session->set_flashdata('success', 'Data saved Successfully');
			redirect(base_url('dashboard/details'));
		}
		if ($user_id != 0) {
			$data['basic_info']  = $this->users->get_basicInfo($user_id);
			$data['user_details']  = $this->users->get_user_details($user_id);
		}
		loadLayout('user/applications', $data);
	}
	public function user_manual()
	{
		$this->user_info     =  $this->common->__check_user_session();
		$data = null;
		loadLayout('user/usermanual', $data);
	}
	public function admit_card()
	{
		// $data = null;
		// loadLayout('user/admitcard');
		$this->user_info     =  $this->common->__check_user_session();
		$this->load->view('user/admitcard');
	}
	public function help()
	{
		$data = null;
		// loadLayout('user/admitcard');
		$this->user_info     =  $this->common->__check_user_session();
		loadLayout('user/help', $data);
	}
	

}
