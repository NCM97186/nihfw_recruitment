<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
	function __construct(){
        parent::__construct();
		 // Load session library
        $this->load->library('session');
        
        // Load the captcha helper
        $this->load->helper('captcha');
    }

	public function index()
	{
	  $data = null;
	  if($this->config->item('captcha_enabled')){
            $data['captcha'] =  $this->captcha();
		}
	  loadLayout('home/registration', $data);

	}
    private function captcha(){
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            // 'font_path'     => 'system/fonts/texb.ttf',
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
        
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Display captcha image

        return $captcha;
    }

    function refresh_captcha(){

        $captcha = $this->captcha();
        echo $captcha['image'];
    }
  
}
