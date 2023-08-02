<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Resetpass extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model( 'Verify_model' );
        
				//if(!$_SESSION['cand_id']){redirect('/');}
    }

    public function index() {
        $this->load->helper( 'string' );
        $data = null;
        //echo 'here';die;
        $otp = random_string( 'numeric', 5 );
				//$otp=12345;
        $_SESSION['user_otp'] = $otp;
				//$mobile=$_SESSION['mobile'];
        //$this->session->userdata
       // $this->sendOTP($mobile, $otp );
        //echo 'hare krishna';
        //die;
        loadLayout('home/resetpassword', $data);

    }


    public function verify_otp() {

        $r_otp = $_POST['otp_text'];
        $data = [];
        //$s_otp = $_SESSION['user_otp'];
        if($r_otp){
          $otpverifytime = $_SERVER["REQUEST_TIME"];
          $getdbotp =  $this->session->userdata('fotp');
          $registrationnumber = $this->session->userdata('registration_number');
          
          
          if($this->session->userdata('otp_verified_status') == 1){
            $this->session->unset_userdata('success');
            
          }else if(($otpverifytime - $this->session->userdata('otp_sendtime')) < 300 && ($r_otp == $getdbotp)){
              $verifiedflag = $this->session->set_userdata('otp_verified_status', 1);
              //echo $verifiedflag;
              $this->session->set_userdata('success', 'Otp verified Successfully. Now you can update your password.');
            }
            
            
           
            //echo $otpverifytime - $getdbotp->currenttime;
          }else if(($otpverifytime - $getdbotp->currenttime) > 300){
            $this->session->unset_userdata('success');
            $this->session->set_userdata('error', 'OTP Expired!! Please send otp again');
             
           }else{
            $this->session->unset_userdata('success');
            $this->session->set_userdata('error', 'Invalid OTP');
            
          }
          
        
        //print_r($data);
        //$this->session->set_flashdata( 'success', 'Invalid OTP' );
				//redirect('Verify');
        //$this->load->view('home/verify', $data);
        redirect('resetpass');

    }

    public function updatepassword(){
      $newpassword = $_POST['new_pass'];
      $confirmpass = $_POST['confirm_pass'];
      if($newpassword != $confirmpass){
        $this->session->unset_userdata('success');
        
        $this->session->set_userdata('error', 'Password not matched');
        redirect('resetpass');
      }else{
        $verified = 0;
        $updateddata = array('password' => hash('sha512',$newpassword));    
        $this->db->where('registration_number', $this->session->userdata('registration_number'));
        $this->db->update('users', $updateddata);
        $this->session->set_userdata('otp_verified_status', 0);
        $this->session->set_userdata('success', 'Password Updated Successfully');
        redirect('user/index');
      }
    }

    public function ResendsendOTP() {
			$smscurl = 'http://117.239.183.111/SMSSend/sendSmsNormal?';
      $mobile = $this->session->userdata('cand_mob');
      $senderid = 1107168187177299332;
      $otp = rand(100000, 999999);
      $cid = 415;

			$postDataArray = [
				"campaign_id"=>1000016,
				"cid"=>$cid,
				"parm"=>'{"<otp>":"'.$otp.'"}',
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
        $this->session->set_userdata('fotp', $otp);
        $this->session->set_userdata('success', 'Otp has been send to your registered mobile number.');
        //loadLayout( 'home/verify' );
        loadLayout('home/resetpassword');
				//echo $response;
			}
			   
			curl_close($ch);
		//die;
        //    echo json_encode( $data );
    }

}
