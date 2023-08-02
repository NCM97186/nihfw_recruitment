<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
        parent::__construct();
	    	$this->load->model('Notifications_model');
	    	$this->load->model('Users_model','users'); 
            $this->load->helper('cookie');
		    $this->load->helper('string');
    }

	public function applyjob($post_id="")
	{
		 /*if($this->uri->segment(3)==""){
			 redirect ();
		 }*/
		// Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            // 'font_path'     => 'system/fonts/texb.ttf',
            'font_path'     => realpath('system/fonts/texb.ttf'),
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 5,
            'font_size'     => 18
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);
        
        // Pass captcha image to view
        $data['captchaImg'] = '<img style="padding-top: 0%;"  src="'.base_url('captcha_images/'.$captcha['filename']).'">';
		
	    //$data = null;
		 $data['result']=$this->Notifications_model->get_jobPost($post_id);
	   loadLayout('home/index', $data);

	}
  
	public function save()
	{
		$cand_id='';
		// $t=$this->Notifications_model->getCandID();
		// $cand_id=(int)$t->cand_id+1;
		// echo $cand_id;die;
		$data=null;
		//echo "<pre>";
		//print_r($_POST);die;
		$userid = $this->session->userdata('id');
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('image', '', 'callback_file_check');
		$this->form_validation->set_rules('signature', 'Please upload your Signature', 'required');
		$this->form_validation->set_rules('cand_name', 'Name of the applicant ', 'required');
		$this->form_validation->set_rules('cand_addr', 'address ', 'required');
		$this->form_validation->set_rules('cand_office', 'Office where working at present ', 'required');
		$this->form_validation->set_rules('cand_mob', 'Mobile Number', 'required');
		$this->form_validation->set_rules('cand_email', 'E-Mail', 'required');
		$this->form_validation->set_rules('cand_addr_corr', 'Corresponding Address', 'required');
		$this->form_validation->set_rules('day', 'Day', 'required');
		$this->form_validation->set_rules('mon', 'Month', 'required');
		$this->form_validation->set_rules('year', 'year', 'required');

    if($this->form_validation->run() == TRUE)
    {

      //$data = array();
      loadLayout('home/index',$data);
    }
    else
    {
			$img='';
			$sign='';

			if(isset($_FILES['image']['name'])){
				$this->load->library('upload');
				$config['upload_path']=APPPATH.'../uploads/';
				$config['allowed_types']='gif|jpg|jpeg|png';
				$config['file_name']=date('YmdHms').'_'.rand(1,999999);
				$this->upload->initialize($config);
				if($this->upload->do_upload('image')){
					$uploaded=$this->upload->data();
					//var_dump($uploaded);die;
					$img=$uploaded['file_name'];
				}
			}
			if(isset($_FILES['signature']['name'])){
				$this->load->library('upload');
				$config['upload_path']=APPPATH.'../uploads/sign';
				$config['allowed_types']='gif|jpg|jpeg|png';
				$config['file_name']=date('YmdHms').'_'.rand(1,999999);
				$this->upload->initialize($config);
				if($this->upload->do_upload('signature')){
					$uploaded=$this->upload->data();
					//var_dump($uploaded);die;
					$sign=$uploaded['file_name'];
				}
			}
			$t=$this->Notifications_model->getCandID();
			$cand_id=(int)$t->cand_id+1;
			$d=$this->input->post('day');
			$m=$this->input->post('mon');
			$y=$this->input->post('year');
			$cand_dob=$y."-".$m."-".$d;
			//echo $cand_dob;
      $data = array(
				'cand_id' => $cand_id,
				'image' => $img,
				'signature'=> $sign,
				'post_id' => $this->input->post('post_id'),
				'cand_name' => $this->input->post('cand_name'),
				'cand_mob' => $this->input->post('cand_mob'),
				'cand_addr' => $this->input->post('cand_addr'),
				'cand_addr_corr' => $this->input->post('cand_addr_corr'),
				'cand_email' => $this->input->post('cand_email'),
				'cand_landline' => $this->input->post('cand_landline'),
				'cand_office' => $this->input->post('cand_office'),
				'cand_pincode' => $this->input->post('cand_pincode'),
				'cand_cat' => $this->input->post('cand_cat'),
				'cand_brief_service_perticular' => $this->input->post('cand_brief_service_perticular'),
				'cand_exp_in_health_sec' => $this->input->post('cand_exp_in_health_sec'),
				'cand_dob'=>$cand_dob,
				'userid'=>$userid
        );
		 
      $this->Notifications_model->insert_update($data);
			$insert=array();
			foreach($_POST['qyear'] as $key => $value ){
				if(empty($value)){break;}
				$insert=array();
				$insert['cand_id']=$cand_id;
				$insert['year']=$_POST['qyear'][$key];
				$insert['degree']=$_POST['deg'][$key];
				$insert['subject']=$_POST['sub'][$key];
				$insert['univ']=$_POST['uni'][$key];
				$insert['division']=$_POST['div'][$key];
			$this->Notifications_model->insertQual($insert);
			}

      $this->session->set_flashdata('success', 'Data saved Successfully. An OTP has send to your mobile no kindly verify it');

      redirect('Verify');

    }
 }
 /*
     * file value and type check during validation
     */
    public function file_check($str){
        $allowed_mime_type_arr = array('application/pdf','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['image']['name']);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }

   public function refresh(){
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            // 'font_path'     => 'system/fonts/texb.ttf',
            'font_path'     => realpath('system/fonts/texb.ttf'),
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 5,
            'font_size'     => 18
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Display captcha image
        echo $captcha['image'];
    }
	
	public function error404(){
		
		$data 						= array();
		$data['page_title'] 	= 'OOPs!!! Error Page';
	
		$this->load->view('errors/error_404', $data);
	}
	
	public function customerror(){
		
		$data 						= array();
		$data['page_title'] 	= 'OOPs!!!';
		
		$this->load->view('errors/error_404', $data);
	}
}
