<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Verify extends CI_Controller {
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
        //$this->sendOTP($mobile, $otp );
        //echo 'hare krishna';
        //die;
        loadLayout( 'home/verify', $data );

    }
		public function verify_msg(){
			$data = null;
			$this->Verify_model->otp_add();
			loadLayout( 'home/verify', $data );

		}
           
    public function sendOTP( $mobile, $otp ) {
        // http://117.239.178.202/newsendsms.php?campaign_id = 100071&cid = 6854&params = {'<otp>':'1234'}&mobile = 8130087845&sender_id = 5616115
			//	http://117.239.178.202/newsendsms.php?campaign_id=100071&cid=6854&params={"<otp>":"1234"}&mobile=783871912&sender_id=5616115

				$data = array(
			    'campaign_id' => '100071',
			    'cid' => '6854',
			    'params' => '{"<otp>":" '.$otp.'"}',
			    'mobile' => $mobile,
				  'sender_id' => '5616115'
			  );
			//$mobile='7838713912';
        //$url = 'https://117.239.178.202/newsendsms.php?'.http_build_query($data) ;
				$url = 'http://117.239.178.202/newsendsms.php?campaign_id=100071&cid=6854&params='.urlencode('{"<otp>":"'.$otp.'"}').'&mobile='.$mobile.'&sender_id=5616115';
				//echo $url;
        //$response = file_get_contents( $url );
        //  $data['status'] = 0;
        //$data['message'] = $response;
        // if ( strstr( $response, 'SUCCESS' ) ) {
        //     $data['status'] = 1;
        //     $data['identifier'] = $identifier;
        // }
				//var_dump($response);
        //Initialize cURL.
        $ch = curl_init();

        //Set the URL that you want to GET by using the CURLOPT_URL option.
        curl_setopt( $ch, CURLOPT_URL, $url );

        //Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        //Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );

        //Execute the request.
        $data = curl_exec( $ch );

        //Close the cURL handle.
        curl_close( $ch );

        //Print the data out onto the page.
        //var_dump( $data );
        //echo 'shri radhey';

        //    echo json_encode( $data );
    }

    public function verify_otp() {

        $r_otp = $_POST['otp_text'];
        $data = [];
        //$s_otp = $_SESSION['user_otp'];
        if($r_otp){
          $otpverifytime = $_SERVER["REQUEST_TIME"];
         
          $getdbotp =  $this->db->get_where('users', array('otp' => $r_otp))->row();
         
          if(empty($getdbotp)){
            $this->session->set_flashdata('error', 'Invalid OTP');
            redirect('verify');
          }
          $username = $getdbotp->registration_number;
          $temppass = $getdbotp->temppass;
          //print_r($getdbotp->cand_mob);
          $recivermobile = $getdbotp->cand_mob;
          $smscurl = 'http://117.239.183.111/SMSSend/sendSmsNormal?';
          
          if($getdbotp->verified == 1){
            
            $this->session->set_flashdata('error', 'You have already verified!!');
          }else if(($otpverifytime - $getdbotp->currenttime) < 300 && ($r_otp == $getdbotp->otp)){

            $postDataArray = [
              "campaign_id"=>1000016,
              "cid"=>414,
              "parm"=>'{"<username>":"'.$username.'","<password>":"'.$temppass.',"<post>":"test"}',
              "mobile"=>$recivermobile,
              "sender_id"=>1107168187167045106,
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
              $verified = 0;
              $updateddata = array('verified' => 1);    
              $this->db->where('otp', $r_otp);
              $this->db->update('users', $updateddata);
              $this->session->set_flashdata('success', 'Otp verified Successfully. An Password and registration number has send to your mobile No. Plz login');
              redirect('user/index');
            }
               
            curl_close($ch);
            
            
           
            //echo $otpverifytime - $getdbotp->currenttime;
          }else if(($otpverifytime - $getdbotp->currenttime) > 300){
            
            $this->session->set_flashdata('error', 'OTP Expired!! Please send otp again');
             
           }else{
            
            $this->session->set_flashdata('error', 'Invalid OTP');
            
          }
          
        }
        //print_r($data);
        //$this->session->set_flashdata( 'success', 'Invalid OTP' );
				//redirect('Verify');
        //$this->load->view('home/verify', $data);
        loadLayout( 'home/verify' );

    }

    public function ResendsendOTP() {
			$smscurl = 'http://117.239.183.111/SMSSend/sendSmsNormal?';
      $mobile = $this->session->userdata('cand_mobile');
      $senderid = 1107168173127410352;
      $otp = rand(100000, 999999);
      $cid = 413;

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
        $updateddata = array('otp' => $otp);    
        $this->db->where('cand_mob', $mobile);
        $this->db->update('users', $updateddata);
        
        $this->session->set_flashdata('success', 'Otp has been send to your registered mobile number.');
        loadLayout( 'home/verify' );
				//echo $response;
			}
			   
			curl_close($ch);
		//die;
        //    echo json_encode( $data );
    }

}
