
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('loginmodel','',TRUE);
	    $this->table        =   "tbl_ip";

        // Load session library
        $this->load->library('session');
        
        // Load the captcha helper
        $this->load->helper('captcha');
        $this->load->helper('cookie');
    }
	
    public function index(){
         
        if(isset($_SESSION['ADMIN']['admin_id']) || $this->loginmodel->remember_me_check()) {
            redirect(base_url('admin/dashboard'));
        }
      
        
        $data['page_title'] =   "Login Page";
        $data['captcha'] =  $this->captcha();
        $this->load->view('common/loginheader',$data);
        $this->load->view('login',$data);
        $this->load->view('common/loginfooter',$data); 
    }
    
    public function getlogin(){
        $this->load->helper('common');
        if(isset($_SESSION['ADMIN']['admin_id'])) {
            redirect(base_url('admin/dashboard'));
        }
		$where = array('username' => $this->input->post('username'));
        $res = $this->loginmodel->view_single($where);
		if((int)$res['flag_id']+60 >time()){
			$message    = "You Are Login To Another Browser";
            $this->session->set_flashdata('message', $message);
			redirect(base_url('login'));
		}
		$audit_data = array('user_login_id' => 1,
						'page_id'           => 10,
						'page_name'         => "login",
						'page_action'       => "Login",
						'page_category'     => "Login",
						'lang'      		=> "Eng",
						'page_title'        => 'Login Page',
						'approve_status'    => "3",
						'usertype'          => "admin"
					);

        $data['remember_me']=$this->input->post('remember_me');
        $this->session->set_userdata('captcha_answer',$this->input->post('code'));
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_validatelogin');

        $captcha_error = false;

        $Captchapost = $this->input->post('captcha');
        if( $Captchapost != $this->session->userdata('captcha_answer')){
						
            $captcha_error = true;
        }
        

        if($captcha_error) {

            $message="captcha is not matched";
            $this->session->set_flashdata('message', $message);
            redirect(base_url('login'));
        }
        else if($this->form_validation->run() == FALSE ){
            $message    = "Invalid Login Details";
            $this->session->set_flashdata('message', $message);          
            redirect(base_url('login'));
        }
        else{
            audit_trail($audit_data);
            if($this->input->post('remember_me')){
               $admin_id=$_SESSION['ADMIN']['admin_id'];
               $this->loginmodel->remember_enter($admin_id);    
            }
            // setcookie('Temp',$_SESSION['saltCookie'], time() + (86400 * 30), "/");
            // $_SESSION['Temptest'] = $_SESSION['saltCookie'];
            $data = array('flag_id' => time(),'last_session'=>session_id());
		if(isset($_SESSION['ADMIN']['admin_id'])){
			$update = array('admin_id' => $_SESSION['ADMIN']['admin_id']);
			$this->loginmodel->updateflag($data,$update);
		}
            redirect(base_url('admin/dashboard'));
        }
      redirect(base_url('login'));
            }

    //Validating user request for login
    public function validatelogin(){
       
        $username      =   array(
            "username"=>$this->input->post('username')
        );  
        $password      =   strtoupper($this->input->post('password'));

        return $this->loginmodel->getlogin($username, $password);
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

    function refresh_captcha(){

        $captcha = $this->captcha();
        echo $captcha['image'];
    }
    public function forgotpassword()
    { 
       
    
        $data['page_title'] =   "Login Page";
        $data['captcha'] =  $this->captcha();
        $this->load->view('common/loginheader');
        $this->load->view('forgotpassword',$data);
        $this->load->view('common/loginfooter');
    }

    public function reset_password()
    {
      
            $data = array();
            $this->session->set_userdata('captcha_answer',$this->input->post('code'));
            $data['title'] = "Admin Forgot Password";
            if (isset($_POST['user_email'])) {
                $_POST = $this->security->xss_clean($this->input->post());
                // $_POST = clean_data_array($_POST); 
                foreach ($_POST as $postKey => $postValue) 
                {
                    $data[$postKey] = $postValue;
                }
                $captcha_error = false;
                $Captchapost = $this->input->post('captcha');
                if($Captchapost == '' || $Captchapost != $this->session->userdata('captcha_answer')) {
                    $captcha_error = true;
                }
                            
            if($captcha_error) {
                $message="captcha is not matched";
                $this->session->set_flashdata('message', $message);
                redirect(base_url('login/forgotpassword'));
            }

                $this->load->library('form_validation');
                $this->form_validation->set_rules('user_email', 'Email', 'trim|required');
                // $this->form_validation->set_rules('captcha', "Captcha", 'required');
    
                if ($this->form_validation->run() == FALSE) {
                    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                    // $data['captchImage'] = generate_captcha('adminLogin');
                    $this->load->view('login/forgotpassword', $data);
                } 
                else 
                {
    
                    // if (!validate_captcha('adminLogin')) {
                    //     $data['error'] = "Invalid Captcha.";
                    // }
                    // else 
                    // {
                        $where['email'] = $this->input->post('user_email');
                       
                        $resultUsers = $this->loginmodel->view($where);
                      
                        if(count($resultUsers) >0){
                            foreach ($resultUsers as $row => $val) {
                                $i=0;
                                $pArray = array();
                                
                                $id  				= $val['admin_id'];
                               
                                $pass   = rand(000000,999999);
                               
                                $dbpass['password'] = hash("sha512", $pass);
                                $result = $this->loginmodel->save($id,$dbpass);
                                // print_r($result);
                                // die();
                                if($result > 0){	
                                
                                    // $passlink = site_url('admin/login/activePass/'.trim($pArray['user_pass']));
                                    
                                    $html  = '';
                                    $html .= 'Dear '.$val["fname"].', <br>';
                                    $html .= 'Your new password is:  '.$pass.', <br>';
                                    // $html .= 'Please click below link to varify your new password<br>';
                                    // $html .= 'Link is:  <a href="'.$passlink.'">'.$passlink.'</a> <br><br><br>';
                                    $html .= 'Thanks & Regard,<br>';
                                    $html .= 'NIHFW Team';
                                    
                                     $from_email = "your@example.com"; 
                                     $to_email = $this->input->post('user_email'); 
                               
                                     //Load email library 
                                     $this->load->library('email'); 
                               
                                     $this->email->from($from_email, 'NIHFW'); 
                                     $this->email->to($to_email);
                                     $this->email->subject('Forgot Password'); 
                                     $this->email->message($html); 
                               
                                     //Send mail 
                                    $this->email->send();
                                  
                                    $this->session->set_flashdata('success', '<span style="color:green;">New Password has been sent to your email id. Your new password is:  '.$pass.', <br></span> ');
                                    redirect('login/forgotpassword');
                                }
                                $i++;
                            }
                        }else{
                            $dataerror = "Invalid email id.";
                            $this->session->set_flashdata('error', $dataerror);
                        }
    
                }
            } else {
                //$data['captchImage'] = generate_captcha('adminLogin');
                $this->load->view('login/forgotpassword', $data);
            }
            redirect('login/forgotpassword');
        
    }


    public function generateSalt() {
        $salt = isset($_SESSION['salt']) ? $_SESSION['salt'] : '';
        if($salt == "")
        {
            $salt =uniqid(rand(59999, 199999));
            $saltCookie =uniqid(rand(59999, 199999));
            $_SESSION['salt']=$salt;
            $_SESSION['saltCookie'] =$saltCookie;
            //  echo $saltCookie;
        }
    }

	
}