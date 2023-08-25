<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->user_info     =  $this->common->__check_user_session();
		$this->load->model('Users_model', 'users');
		$this->load->model('JobPost_model', 'jobpost');
		$this->load->model('Category_model', 'Category_model');
		$this->load->model('Notifications_model');
	}
	
	function randomPassword()
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	public function dtttm($app)
	{
		$ref = '';
		if (!empty($app)) {
			$td = str_replace('/', '-', $app);
			$ref = date('Y-m-d', strtotime($td));
		}
		return $ref;
	}
	public function dttt($app)
	{
		$apdate_dd = '';
		$apdate = '';
		if (!empty($app)) {
			if (strstr($app, '.')) {
				$apdate = explode('.', $app);
				if (!isset($apdate[2])) {
					echo $app;
					die;
				}
				if (strlen($apdate[2]) == 2) {
					if ($apdate[2] > 20) {
						$apdate[2] = '19' . $apdate[2];
					} else {
						$apdate[2] = '20' . $apdate[2];
					}
				}
				$apdate_dd = $apdate[2] . '-' . $apdate[1] . '-' . $apdate[0];
			} elseif (strstr($app, '-')) {
				$apdate = explode('-', $app);
				if (!isset($apdate[2])) {
					echo $app;
					die;
				}
				if (strlen($apdate[2]) == 2) {
					if ($apdate[2] > 20) {
						$apdate[2] = '19' . $apdate[2];
					} else {
						$apdate[2] = '20' . $apdate[2];
					}
				}
				$apdate_dd = $apdate[2] . '-' . $apdate[1] . '-' . $apdate[0];
			}
		}
		return $apdate_dd;
	}
	public function basicinfo()
	{

		$data = null;
		$user_id = $_SESSION['USER']['user_id'];
		$post_id = isset($_COOKIE['post_id']) ? $_COOKIE['post_id'] : null;
		$application_id =   $this->users->get_application_id();
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('cand_mob', 'Phone No.', 'required');
		$this->form_validation->set_rules('cand_email', 'Email ID ', 'required');
		if ($this->input->post('basicinfo') && $this->form_validation->run() != FALSE) {
			
			$post_val = $this->input->post();
			$update_array = array(
				'first_name' => $post_val['first_name'],
				'middel_name' => $post_val['middel_name'],
				'last_name' => $post_val['last_name']
			);
			$this->db->where("user_id", $user_id);
			$this->db->update("users", $update_array);
			$this->session->set_flashdata('success', 'Data saved Successfully');
			$val=array(
				'application_id' => $application_id,
				'user_id' => $user_id,
				'post_id' => $post_id
		    );
			$this->users->insert_update_user_details($val);
			redirect(base_url('dashboard/basic_details'));
		}
		if ($user_id != 0) {
			$data['basic_info']  = $this->users->get_basicInfo($user_id);
		}

		loadLayout('user/basicInfo', $data);
	}

	public function UserDashboard()
	{
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
		}
		$data['result']=$this->Notifications_model->get_jobPost();
		
		loadLayout('user/dashboard', $data);
	}

	public function photo_signature()
	{
		$user_id = $_SESSION['USER']['user_id'];
		$data = array();

		$data['basic_info']  = $this->users->get_basicInfo($user_id);

		loadLayout('user/photo_signature', $data);
	}

	public function details()
	{    
		//echo"<pre>";
		//echo $application_id =   $this->users->get_application_id(); //die();
		$_SESSION['profile_filled'] = 'N';
		$data = null;
		$data['category'] = $this->Category_model->get_list();
		$user_id = $_SESSION['USER']['user_id'];
		$post_id = isset($_COOKIE['post_id']) ? $_COOKIE['post_id'] : null;
		//$application_id =   isset($_SESSION['application_id']) ? $_SESSION['application_id'] : null;
		$status=array(5,6);
		$id=  $this->db->select('*')->from('users_detail')->where(array('user_id'=>$user_id, 'post_id'=>$post_id))->where_in('status_id', $status)->get()->row();
		$application_id ='';  
		if(empty($id)){
		    $application_id =   $this->users->get_application_id(); //die();
		   $_SESSION['application_id'] = $application_id;
		}else {
			//print_r(array('user_id' => $user_id, 'post_id' => $post_id, 'status_id' => 5));
			$this->db->select('id,application_id');
			$this->db->where(array('user_id' => $user_id, 'post_id' => $post_id));
			$this->db->order_by('id', 'DESC');
			$q = $this->db->get('users_detail');
			if ($q) {
				$u_details_app_id = $q->row();
				if (!empty($u_details_app_id)) {
					$application_id = $u_details_app_id->application_id;
					$_SESSION['application_id'] = $application_id;
					
					$_SESSION['users_detail_id'] = $u_details_app_id->id;
					$_SESSION['existing_application'] = 'Y';
				}
			}
			//print_r($application_id); die();
			///$application_id = $_SESSION['application_id'];
			$data['user_details']  = $this->users->get_user_details($application_id);
			
			$data['post_detail']  = $this->users->get_candidate($data['user_details']->user_id);

			$data['basic_info']  = $this->users->get_basicInfo($data['user_details']->user_id);
			$degree_diploma = $this->users->get_user_degree_diploma($application_id);

			$edu_file_error = False;
			
			if (!empty($_POST['degree_diploma']) && !empty($degree_diploma)) {
				$degree_diploma_count = count($degree_diploma);
				$post_count = count($_POST['degree_diploma']['deg']);
				$remaining_count = $post_count - $degree_diploma_count;
				if ($remaining_count > 0) {
					for ($i = $degree_diploma_count; $i < $post_count; $i++) {
						$ind = $i + 1;
						$post_degree = array(
							'deg' => $_POST['degree_diploma']['deg'][$ind],
							'year' => $_POST['degree_diploma']['year'][$ind],
							'sub' => $_POST['degree_diploma']['sub'][$ind],
							'uni' => $_POST['degree_diploma']['uni'][$ind],
							'div' => $_POST['degree_diploma']['div'][$ind],
							'per' => $_POST['degree_diploma']['per'][$ind]
						);
						$post_degree['deg_error'] = empty($post_degree['deg']) ? 'The Degree/Diploma field is required.' : '';
						$post_degree['year_error'] = empty($post_degree['year']) ? 'The Board/University field is required.' : '';
						$post_degree['sub_error'] = empty($post_degree['sub']) ? 'The Year of Passing field is required.' : '';
						$post_degree['uni_error'] = empty($post_degree['uni']) ? 'The Max Marks field is required.' : '';
						$post_degree['div_error'] = empty($post_degree['div']) ? 'The Percentage/Marks Obtained field is required.' : '';
						$degree_diploma[] = (object)$post_degree;
					}
				}
				$edu_file_index = 0;
				foreach ($_FILES['education_file']['name']['education_file'] as $edu_file_name) {
					if ($edu_file_index >= $degree_diploma_count && empty($edu_file_name)) {
						$degree_diploma[$edu_file_index]->file_error = 'Education file is required!';
						$edu_file_error = True;
					}
					$edu_file_index++;
				}
			}
			$data['file_error'] = '';
			if (empty($degree_diploma) && isset($_FILES['education_file'])) {
				$degree_diploma = [];
				$edu_file_index = 0;
				foreach ($_FILES['education_file']['name']['education_file'] as $edu_file_name) {
					if (empty($edu_file_name)) {
						//$degree_diploma[$edu_file_index]=(object)array();
						//$degree_diploma[$edu_file_index]->file_error = 'Education file is required!';
						$data['file_error'] = 'Education file is required!';
						$edu_file_error = True;
					}
					$edu_file_index++;
				}
			}
			$data['degree_diploma'] = $degree_diploma;

			$data['work_experience']  = $this->users->get_user_work_experience($user_id);
		}



		if ($this->input->post('validate')) {


			$post_val = $this->input->post();
			// print_r($data['degree_diploma']);
			// die();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('category', 'Category', 'required');
			if ($this->input->post('category') == '1') {
				$this->form_validation->set_rules('category_name', 'Category', 'required');
				if (empty($_FILES['category_attachment']['name']) && empty($this->input->post('old_category_attachment'))) {
					$this->form_validation->set_rules('category_attachment', 'Category Attachment', 'required');
				}
			}

			$this->form_validation->set_rules('benchmark', 'Benchmark', 'required');

			if ($this->input->post('benchmark') == 'Yes') {
				if (empty($_FILES['person_disability']['name']) && empty($this->input->post('old_person_disability'))) {
					$this->form_validation->set_rules('person_disability', 'Person Disability', 'required');
				}
				if (empty($this->input->post('add_disablity'))) {
					$this->form_validation->set_rules('add_disablity', 'Enter Disability', 'required');
				}
			}

			if ($this->input->post('adhar_card_number') != '') {
				if (empty($_FILES['adhar_card_doc']['name']) && empty($this->input->post('old_adhar_card_doc'))) {
					$this->form_validation->set_rules('adhar_card_doc', 'Adhar Card Document', 'required');
				}
			}
			$this->form_validation->set_rules('dob', 'DOB', 'required');
			$this->form_validation->set_rules('department', 'Department', 'required');
			$this->form_validation->set_rules('gender', 'Gender ', 'required');
			$this->form_validation->set_rules('department', 'Department ', 'required');
			$this->form_validation->set_rules('marital_status', 'Marital status', 'required');
			$this->form_validation->set_rules('father_name', 'Father name', 'required');
			$this->form_validation->set_rules('mother_name', 'Mother name', 'required');
			$this->form_validation->set_rules('identity_proof', 'Identity proof', 'required');
			$this->form_validation->set_rules('adhar_card_number', 'Adhar Card Number', 'required');
			$this->form_validation->set_rules('corr_address', 'Present Postal Address', 'required');
			$this->form_validation->set_rules('corr_state', 'State', 'required');
			$this->form_validation->set_rules('corr_pincode', 'Pincode', 'required');
			$this->form_validation->set_rules('perm_address', 'Permanent Address', 'required');
			$this->form_validation->set_rules('perm_state', 'Permanent State', 'required');
			$this->form_validation->set_rules('perm_pincode', 'Permanent Pincode', 'required');
			$this->form_validation->set_rules('degree_diploma[deg]', 'Degree/Diploma', 'required');
			$this->form_validation->set_rules('degree_diploma[year]', 'Board/University', 'required');
			$this->form_validation->set_rules('degree_diploma[sub]', 'Year of Passing', 'required');
			$this->form_validation->set_rules('degree_diploma[uni]', 'Max Marks', 'required');
			$this->form_validation->set_rules('degree_diploma[div]', 'Percentage/Marks Obtained', 'required');
			//$this->form_validation->set_rules('education_file[education_file]', 'Education File', 'required');
			if (empty($_FILES['photograph']['name']) && empty($this->input->post('old_photo'))) {
				$this->form_validation->set_rules('photograph', 'Photograph', 'required');
			}
			if (empty($_FILES['signature']['name']) && empty($this->input->post('old_sign'))) {
				$this->form_validation->set_rules('signature', 'Signature', 'required');
			}
			if (empty($_FILES['dob_doc']['name']) && empty($this->input->post('old_dob_doc'))) {
				$this->form_validation->set_rules('dob_doc', 'DOB Document', 'required');
			}
		}
		$edu_file_error = False;



	    if ($this->form_validation->run() != FALSE && !$edu_file_error) {
			if ($this->input->post('dob') != '' && $this->input->post('post_id')) {
				$dob_age = "";
				//$post_detail  = $this->users->get_candidate_dob($this->input->post('dob'),$this->input->post('post_id')); 

				$this->db->where('post_id', $this->input->post('post_id'));
				// here we select every column of the table
				$q = $this->db->get('jobpost');
				$datapost = $q->result_array();

				// calculate jobpost age

				$candidate_age = $this->input->post('candtotal_age');
				$candidate_category = $this->input->post('category_name');
				$gen_category = $this->input->post('category');
				// echo $candidate_category;
				// die();
				if ($candidate_category == '' && $gen_category == 2) {
					$candidate_category = 'UR';
					$post_val['category_name'] = $candidate_category;
				}
				$candidateorganization = $this->input->post('department');
				$workexperience = $this->input->post('work_experience');

				// Start Kesh
				//already apply code
             $where = array('application_id' => $application_id,'post_id' => $post_val['post_id']);

			 $alreadypost = $this->db->select('post_id')->from('users_detail')->where('status_id',1)->where($where)->get()->row();
				// print_r($alreadypost);
				// die();
			if($alreadypost){

				if($post_val['gender'] == "Female"){
					redirect(base_url('dashboard/already_apply'));
				}
					
				$cat_result = $this->db->from('category')->select('id')->where('category', $candidate_category)->get()->row();
				$cat_id = $cat_result->id;
				$gid = $this->db->select("group_id,fee_applicable")->from('jobpost')->where('post_id', $post_val['post_id'])->get()->row();
				$groupid = $gid->group_id;
				$data['fee_applicable'] = $gid->fee_applicable;
				$data['fee'] = $this->db->select('fee')->from('fee')->where('cat_id', $cat_id)->where('group_id', $groupid)->get()->row();
				if($gid->fee_applicable == 1){
					if($data['fee'] == ""){
					redirect(base_url('dashboard/already_apply'));
					}
				}else{
					redirect(base_url('dashboard/already_apply'));
				}
			}
                // end already apply code
             //calculate from 01 July YYYY
				$currentdate = date("Y-07-01");
				$d1 = $datapost[0]['min_age_date'];
				$d2 = $datapost[0]['max_age_date'];

				$diff =  strtotime($currentdate) - strtotime($d2);

				$maxelegbleyearforpost = round($diff / (60 * 60 * 24));

				$datediff = strtotime($currentdate) - strtotime($d1);
				$minageindaysforpost = round($datediff / (60 * 60 * 24));
				$statusre=false;
	            
				if($minageindaysforpost >= $candidate_age) {


					$years = ($candidate_age / 365); // days / 365 days
					$years = floor($years); // Remove all decimals

					$month = ($candidate_age % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
					$month = floor($month); // Remove all decimals

					$days = round(($candidate_age / (60 * 60 * 24))); // the rest of days

					// Echo all information set

					$candage =  $years . ' years - ' . $month . ' month  - ' . $days . ' Days ';

					$eyears = ($minageindaysforpost / 365); // days / 365 days
					$eyears = floor($eyears); // Remove all decimals

					$emonth = ($minageindaysforpost % 365) / 31; // I choose 30.5 for Month (30,31) ;)
					$emonth = floor($emonth); // Remove all decimals

					$edays = round(($minageindaysforpost / (60 * 60 * 24)));
					// the rest of days

					// Echo all information set

					$epostage =  $eyears . ' years - ' . $emonth . ' month - ' . $edays . ' Days ';
					$this->session->set_flashdata('error', ' you are not eligible to apply this post. because Your Age is ' . $candage . '. you must be ' . $epostage . 'to apply this post.');
					redirect(base_url('dashboard/details'));
					//loadLayout('user/details', $data);
					$statusre=false;
				 }
				 //else{
				// 	$status=false;
				// }
			



				if ((isset($candidate_category) || isset($gen_category)) && isset($workexperience)) {
					//$this->db->where('category', $candidate_category);
					// print_r($candidate_category);
					// die();
					$catq = $this->db->where('category', $candidate_category)->get('category');
					$datacat = $catq->result_array();
					// print_r($datacat);
					// die();
					$categoryid = $datacat[0]['id'];
					$benchmark = $this->input->post('benchmark');
					if ($benchmark == 'Yes') {
						$pwbd = 1;
					} else {
						$pwbd = 0;
					}
					if ($categoryid) {
						//$where = array('catid'=> $categoryid, 'Person_disablity'=> $pwbd);

						$age_relq = $this->db->query('select * from age_relaxation where catid=' . $categoryid . ' and Person_disablity="' . $pwbd . '"');
						$age_rel = $age_relq->result_array();
					}
					// calculate exserviceman age relaxation


					$totalyears = 0;
					$totalmonth = 0;
					$totaldays = 0;
					$totalexpinday = 0;

					if (isset($workexperience['from_date']) && isset($workexperience['to_date'])) {
						for ($i = 0; $i <= count($workexperience['from_date']) - 1; $i++) {
							$diff = abs(strtotime($workexperience['to_date'][$i]) - strtotime($workexperience['from_date'][$i]));

							$totalyearexperiencecandidate = floor($diff / (365 * 60 * 60 * 24));
							$totalmonthexperience =  floor(($diff - $totalyearexperiencecandidate * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
							$totaldayexperience = floor(($diff - $totalyearexperiencecandidate * 365 * 60 * 60 * 24 - $totalmonthexperience * 30 * 60 * 60 * 24) / (60 * 60 * 24));
							$totalyears += $totalyearexperiencecandidate;
							$totalmonth += $totalmonthexperience;
							$totaldays += $totaldayexperience;

							//echo $experience = $workexperience['from_date'][$i]. 'to'.$workexperience['to_date'][$i].'<br>';
						}
						$totalexpinday = ($totalyears * 365) + ($totalmonth * 30) + $totaldays;
						//echo $totalexperience = $totalyears.' years '.$totalmonth.' month '.$totaldays.' days <br>';
					}

					// Kesh Experience Validation
                    if(!empty($datapost[0]['experience']))
					{
						$post_experince = $datapost[0]['experience'];
						$min_experience = $post_experince/365;
						if($post_experince > $totalexpinday)
						{
							$this->session->set_flashdata('error', ' You have minimum of ' . $min_experience . ' years of experience for applying for this post.');
							redirect(base_url('dashboard/details'));
						//loadLayout('user/details', $data);
							$statusre=false;
					    }
					}
					// End Experience Validation

					if (!empty($age_rel)) {

						// ST +pwbd category age relaxation
						if (($age_rel[0]['catid'] == 5) && $pwbd == 0) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365) + $totalexpinday;
						} elseif (($age_rel[0]['catid'] == 5) && $pwbd == 1) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365) + $totalexpinday;
						} elseif (($age_rel[0]['catid'] == 3) && $pwbd == 0) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365) + $totalexpinday;
						} elseif (($age_rel[0]['catid'] == 3) && $pwbd == 1) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365) + $totalexpinday;
						} elseif (($age_rel[0]['catid'] == 6) && $pwbd == 0) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365) + $totalexpinday;
						} elseif (($age_rel[0]['catid'] == 6) && $pwbd == 1) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365) + $totalexpinday;
						} elseif ($age_rel[0]['catid'] && $pwbd == 1) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365) + $totalexpinday;
						} elseif ($age_rel[0]['catid'] == 11 && $pwbd == 0) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365) + $totalexpinday;
						} elseif ($age_rel[0]['catid'] == 18 && $pwbd == 0) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365) + $totalexpinday;
						} elseif ($age_rel[0]['catid'] == 18 && $pwbd == 1) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365) + $totalexpinday;
						}
					}
					// echo "hii".$maxelegbleyearforpost;
					// echo "<br>";
					// echo "hnsajcb".$candidate_age;
					// die();

					if ($candidate_age > $maxelegbleyearforpost) {
						$years = ($candidate_age / 365); // days / 365 days
						$years = floor($years); // Remove all decimals

						$month = ($candidate_age % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
						$month = floor($month); // Remove all decimals

						$days = round(($candidate_age / (60 * 60 * 24))); // the rest of days

						// Echo all information set

						$candage =  $years . ' years - ' . $month . ' month - ' . $days . ' Days ';

						$eyears = ($maxelegbleyearforpost / 365); // days / 365 days
						$eyears = floor($eyears); // Remove all decimals

						$emonth = ($maxelegbleyearforpost % 365) / 31; // I choose 30.5 for Month (30,31) ;)
						$emonth = floor($emonth); // Remove all decimals

						$edays = round(($maxelegbleyearforpost / (60 * 60 * 24))); // the rest of days

						// Echo all information set

						$epostage =  $eyears . ' years - ' . $emonth . ' month - ' . $edays . ' Days ';
						$this->session->set_flashdata('error', ' you are not  to apply this post. because Your Age is ' . $candage . '. you must be ' . $epostage . ' (with age relaxation) to apply this post.');
						redirect(base_url('dashboard/details'));
						//loadLayout('user/details', $data);
						$statusre=false;
					}
				}
				if (isset($candidate_category) || isset($gen_category)) {
					$this->db->where('category', $candidate_category);
					$catq = $this->db->get('category');
					$datacat = $catq->result_array();
					$categoryid = $datacat[0]['id'];

					$benchmark = $this->input->post('benchmark');
					if ($benchmark == 'Yes') {
						$pwbd = 1;
					} else {
						$pwbd = 0;
					}
					if ($categoryid) {
						//$where = array('catid'=> $categoryid, 'Person_disablity'=> $pwbd);

						$age_relq = $this->db->query('select * from age_relaxation where catid=' . $categoryid . ' and Person_disablity="' . $pwbd . '"');
						$age_rel = $age_relq->result_array();
					}


					if (!empty($age_rel)) {

						// ST +pwbd category age relaxation
						if (($age_rel[0]['catid'] == 4) && $pwbd == 0) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365);
						} elseif (($age_rel[0]['catid'] == 4) && $pwbd == 1) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365);
						} elseif (($age_rel[0]['catid'] == 3) && $pwbd == 0) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365);
						} elseif (($age_rel[0]['catid'] == 3) && $pwbd == 1) {

							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365);
						} elseif (($age_rel[0]['catid'] == 6) && $pwbd == 0) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365);
						} elseif (($age_rel[0]['catid'] == 6) && $pwbd == 1) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365);
						} elseif ($gen_category == '2' && $pwbd == 1) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365);
						} elseif ($gen_category == '2' && $pwbd == 0) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365);
						} elseif ($age_rel[0]['catid'] == 18 && $pwbd == 0) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365) + $totalexpinday;
						} elseif ($age_rel[0]['catid'] == 18 && $pwbd == 1) {
							//$candidate_age = $candidate_age + $age_rel[0]['relaxation'];
							$maxelegbleyearforpost = $maxelegbleyearforpost + ($age_rel[0]['relaxation'] * 365) + $totalexpinday;
						}else{
							
						}
					}

					if ($candidate_age > $maxelegbleyearforpost) {
						$years = ($candidate_age / 365); // days / 365 days
						$years = floor($years); // Remove all decimals

						$month = ($candidate_age % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
						$month = floor($month); // Remove all decimals

						$days = round(($candidate_age / (60 * 60 * 24))); // the rest of days

						// Echo all information set

						$candage =  $years . ' years - ' . $month . ' month - ' . $days . ' Days ';;

						$eyears = ($maxelegbleyearforpost / 365); // days / 365 days
						$eyears = floor($eyears); // Remove all decimals

						$emonth = ($maxelegbleyearforpost % 365) / 31; // I choose 30.5 for Month (30,31) ;)
						$emonth = floor($emonth); // Remove all decimals

						$edays = round(($maxelegbleyearforpost / (60 * 60 * 24))); // the rest of days

						// Echo all information set

						$epostage =  $eyears . ' years - ' . $emonth . ' month - ' . $edays . ' Days ';

						$this->session->set_flashdata('error', ' you are not  to apply this post. because Your Age is ' . $candage . ' years. you must be ' . $epostage . ' years (with age relaxation) to apply this post.');
						redirect(base_url('dashboard/details'));
						//loadLayout('user/details', $data);
						$statusre=false;
					}



					if ($candidate_age > $maxelegbleyearforpost) {
						$years = ($candidate_age / 365); // days / 365 days
						$years = floor($years); // Remove all decimals

						$month = ($candidate_age % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
						$month = floor($month); // Remove all decimals

						$days = ($candidate_age % 365) % 30.8; // the rest of days

						// Echo all information set

						$candage =  $years . ' years - ' . $month . ' month ';

						$eyears = ($maxelegbleyearforpost / 365); // days / 365 days
						$eyears = floor($eyears); // Remove all decimals

						$emonth = ($maxelegbleyearforpost % 365) / 31; // I choose 30.5 for Month (30,31) ;)
						$emonth = floor($emonth); // Remove all decimals

						$edays = ($maxelegbleyearforpost % 365) % 31; // the rest of days

						// Echo all information set

						$epostage =  $eyears . ' years - ' . $emonth . ' month ';
						$this->session->set_flashdata('error', ' you are not eligible to apply this post. because Your Age is ' . $candage . ' years. you must be ' . $epostage . ' years (with age relaxation) to apply this post.');
						redirect(base_url('dashboard/details'));
						//loadLayout('user/details', $data);
						$statusre=false;
					}
				}
			}
			if (isset($_FILES['category_attachment']) && $_FILES['category_attachment']['name'] != '') {
				$file_name = str_replace(' ','_',$_FILES["category_attachment"]['name']);
				$user_id=$_SESSION['USER']['user_id'];
				$post_id=$_COOKIE['post_id'];
				$unlink ='uploads/category_attachment/'.$user_id."_".$post_id."_".$file_name;
				if (file_exists($unlink)) {
					unlink($unlink);
				}
				$config['upload_path'] = 'uploads/category_attachment/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] =$user_id."_".$post_id."_".$file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('category_attachment')) {
					$upload_data = $this->upload->data();
					$category_attachment = $upload_data['file_name'];
					$post_val['category_attachment'] = $user_id."_".$post_id."_".$file_name;
				} else {
					$error = array('error' => $this->upload->display_errors());
					$label = "Category Attachment";
					
				}
			}
			if (isset($_FILES['adhar_card_doc']) && $_FILES['adhar_card_doc']['name'] != '') {
				$file_name = str_replace(' ','_',$_FILES["adhar_card_doc"]['name']);
				$user_id=$_SESSION['USER']['user_id'];
				$post_id=$_COOKIE['post_id'];
				$unlink ='uploads/adhar_card_doc/'.$user_id."_".$post_id."_".$file_name;
				if (file_exists($unlink)) {
					unlink($unlink);
				}
				$config['upload_path'] = 'uploads/adhar_card_doc/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = $user_id."_".$post_id."_".$file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('adhar_card_doc')) {
					$upload_data = $this->upload->data();
					$adhar_card_doc = $upload_data['file_name'];
					$post_val['adhar_card_doc'] =$user_id."_".$post_id."_".$file_name;
				} else {
					$error = array('error' => $this->upload->display_errors());
					$label = "Adhar Card Doc";
				}
			}
			if (isset($_FILES['person_disability']) && $_FILES['person_disability']['name'] != '') {
				$file_name =str_replace(' ','_',$_FILES["person_disability"]['name']);
				$user_id=$_SESSION['USER']['user_id'];
				$post_id=$_COOKIE['post_id'];
				$unlink ='uploads/person_disability/'.$user_id."_".$post_id."_".$file_name;
				if (file_exists($unlink)) {
					unlink($unlink);
				}
				$config['upload_path'] = 'uploads/person_disability/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] =$user_id."_".$post_id."_".$file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('person_disability')) {
					$upload_data = $this->upload->data();
					$person_disability = $upload_data['file_name'];
					$post_val['person_disability'] = $user_id."_".$post_id."_".$file_name;
				} else {
					$error = array('error' => $this->upload->display_errors());
					$label = "Person Disability";
				}
			}
			if (isset($_FILES['photograph']) && $_FILES['photograph']['name'] != '') {
				$file_name = str_replace(' ','_',$_FILES["photograph"]['name']);
				$user_id=$_SESSION['USER']['user_id'];
				$post_id=$_COOKIE['post_id'];
				$unlink ='uploads/photograph/'.$user_id."_".$post_id."_".$file_name;
				if (file_exists($unlink)) {
					unlink($unlink);
				}
				$config['upload_path'] = 'uploads/photograph/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = '55';
				$config['height']  = '535';
				$config['width']   = '415';
				$config['file_name'] = $user_id."_".$post_id."_".$file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('photograph')) {
					$upload_data = $this->upload->data();
					$photograph = $upload_data['file_name'];
					$post_val['photograph'] =$user_id."_".$post_id."_".$file_name;
				} else {
					$error = array('error' => $this->upload->display_errors());
					$label = "Photograph";
				}
			}
			if (isset($_FILES['signature']) && $_FILES['signature']['name'] != '') {
				$file_name = str_replace(' ','_',$_FILES["signature"]['name']);
				$user_id=$_SESSION['USER']['user_id'];
				$post_id=$_COOKIE['post_id'];
				$unlink ='uploads/signature/'.$user_id."_".$post_id."_".$file_name;
				if (file_exists($unlink)) {
					unlink($unlink);
				}
				$config['upload_path'] = 'uploads/signature/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = '55';
				$config['height']  = '535';
				$config['width']   = '415';
				$config['file_name'] =$user_id."_".$post_id."_".$file_name;
				// print_r($config);
				// die();
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('signature')) {
					$upload_data = $this->upload->data();
					$signature = $upload_data['file_name'];
					$post_val['signature'] = $user_id."_".$post_id."_".$file_name;
				} else {
					$error = array('error' => $this->upload->display_errors());
					$label = "Signature";
				}
			}
			if (isset($_FILES['dob_doc']) && $_FILES['dob_doc']['name'] != '') {
				$file_name = str_replace(' ','_',$_FILES["dob_doc"]['name']);
				$user_id=$_SESSION['USER']['user_id'];
				$post_id=$_COOKIE['post_id'];
				$unlink ='uploads/dob_proof/'.$user_id."_".$post_id."_".$file_name; //die();
				
				if (file_exists($unlink)) {
					unlink($unlink);
				}
				$config['upload_path'] = 'uploads/dob_proof/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = $user_id."_".$post_id."_".$file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('dob_doc')) {
					$upload_data = $this->upload->data();
					$dob_doc = $upload_data['file_name'];
					$post_val['dob_doc'] = $user_id."_".$post_id."_".$file_name;
				} else {
					$error = array('error' => $this->upload->display_errors());
					$label = "Date Of Birth Document";
				}
			}
			if ($this->input->post('identity_proof') == 'DL') {
				$identity_number = $this->input->post('adhar_card_number');
				if (!preg_match('/^(([A-Z]{2}[0-9]{2})( )|([A-Z]{2}-[0-9]{2}))((19|20)[0-9][0-9])[0-9]{7}$/', $identity_number)) {
					$this->session->set_flashdata('error', 'Invalid driving license.');
					redirect(base_url('dashboard/details'));
						//loadLayout('user/details', $data);
				}
			}

			if ($this->input->post('identity_proof') == 'Adhaar') {
				$identity_number = $this->input->post('adhar_card_number');
				if (!preg_match('/^([0-9]{4}[0-9]{4}[0-9]{4}$)|([0-9]{4}\s[0-9]{4}\s[0-9]{4}$)|([0-9]{4}-[0-9]{4}-[0-9]{4}$)/', $identity_number)) {
					$this->session->set_flashdata('error', 'Invalid Aadhar card number.');
					redirect(base_url('dashboard/details'));
						//loadLayout('user/details', $data);
				}
			}

			if ($this->input->post('identity_proof') == 'Pan') {
				$identity_number = $this->input->post('adhar_card_number');
				if (!preg_match('/([A-Z]){5}([0-9]){4}([A-Z]){1}$/', $identity_number)) {
					$this->session->set_flashdata('error', 'Invalid Pan card number.');
					redirect(base_url('dashboard/details'));
						//loadLayout('user/details', $data);
				}
			}

			if ($this->input->post('identity_proof') == 'Passport') {
				$identity_number = $this->input->post('adhar_card_number');
				if (!preg_match('/^[A-PR-WY][1-9]\d\s?\d{4}[1-9]$/', $identity_number)) {
					$this->session->set_flashdata('error', 'Invalid Passport number.');
					redirect(base_url('dashboard/details'));
						//loadLayout('user/details', $data);
				}
			}

			if ($this->input->post('identity_proof') == 'Voter') {
				$identity_number = $this->input->post('adhar_card_number');
				if (!preg_match('/^[A-Z]{3}[0-9]{7}$/', $identity_number)) {
					$this->session->set_flashdata('error', 'Invalid Voter Id.');
					redirect(base_url('dashboard/details'));
						//loadLayout('user/details', $data);
				}
			}
			
			if (isset($_FILES['education_file'])) {
				$errorUploadType = $statusMsg = '';
				//$files = array_filter($_FILES['education_file']['name']);
				$total_count = count($_FILES['education_file']['name']['education_file']);
				$image_path = [];
				$post_val['edu_doc'] = [];
				//for($i = 0; $i < $total_count; $i++){ 
				foreach ($_FILES['education_file']['name']['education_file'] as $i => $v) {
					$_FILES['file']['name']     = $_FILES['education_file']['name']['education_file'][$i];
					if (!empty($_FILES['file']['name'])) {

						$_FILES['file']['type']     = $_FILES['education_file']['type']['education_file'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['education_file']['tmp_name']['education_file'][$i];
						$_FILES['file']['error']     = $_FILES['education_file']['error']['education_file'][$i];
						$_FILES['file']['size']     = $_FILES['education_file']['size']['education_file'][$i];

						// File upload configuration 
						//$uploadPath = 'uploads/education_proof/';
						$user_id=$_SESSION['USER']['user_id'];
						$post_id=$_COOKIE['post_id'];
						$unlink ='uploads/education_proof/'.$user_id."_".$post_id."_".$_FILES['file']['name'][$i];
						if (file_exists($unlink)) {
							unlink($unlink);
						}
						$config['upload_path'] = 'uploads/education_proof/';
						
						$config['allowed_types'] = 'pdf';
						$config['max_size']    = '1024';
						//$config['max_width'] = '1024'; 
						//$config['max_height'] = '768'; 
						$config['file_name'] =$user_id."_".$post_id."_".$_FILES['file']['name'][$i];

						// Load and initialize upload library 
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						//$this->upload->do_upload('file');
						// Upload file to server 

						if ($this->upload->do_upload('file')) {
							// Uploaded file data 
							$fileData = $this->upload->data();
							$uploadData[$i]['file_name'] = $fileData['file_name'];
							$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
							$data = $this->upload->data();
							$image_path[$i] = $fileData['file_name'];
							$post_val['edu_doc'][$i] = $fileData['file_name'];
						} else {
							//echo 'here';
							$errorUploadType .= $_FILES['education_file']['education_file'][$i] . ' | ';
						}
					}
				}
				//$post_val['edu_doc'] = json_encode($post_val['edu_doc']);

			}

			if (isset($_FILES['organization_file'])) {
				$errorUploadType = $statusMsg = '';
				//$files = array_filter($_FILES['education_file']['name']);
				$total_count = count($_FILES['organization_file']['name']['organization_file']);
				$image_path = [];
				$post_val['org_doc'] = [];
				for ($i = 0; $i < $total_count; $i++) {
					$_FILES['file']['name']     = $_FILES['organization_file']['name']['organization_file'][$i];
					$_FILES['file']['type']     = $_FILES['organization_file']['type']['organization_file'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['organization_file']['tmp_name']['organization_file'][$i];
					$_FILES['file']['error']     = $_FILES['organization_file']['error']['organization_file'][$i];
					$_FILES['file']['size']     = $_FILES['organization_file']['size']['organization_file'][$i];

					// File upload configuration 
					
					$user_id=$_SESSION['USER']['user_id'];
					$post_id=$_COOKIE['post_id'];
					$unlink ='uploads/organization_file/'.$user_id."_".$post_id."_".$_FILES['file']['name'][$i];
					if (file_exists($unlink)) {
						unlink($unlink);
					}
					$config['upload_path'] = 'uploads/organization_file/';
					$config['allowed_types'] = 'pdf';
					$config['max_size']    = '1024';
					//$config['max_width'] = '1024'; 
					//$config['max_height'] = '768'; 
					$config['file_name'] = $user_id."_".$post_id."_".$_FILES['file']['name'][$i];

					// Load and initialize upload library 
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					//$this->upload->do_upload('file');
					// Upload file to server 
					if ($this->upload->do_upload('file')) {
						// Uploaded file data 
						$fileData = $this->upload->data();
						$uploadData[$i]['file_name'] = $fileData['file_name'];
						$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
						$data = $this->upload->data();
						$image_path[$i] = $fileData['file_name'];
						$post_val['org_doc'][$i] = $fileData['file_name'];
					} else {
						//echo 'here';
						$errorUploadType .= $_FILES['file']['name'] . ' | ';
					}
				}
				//$post_val['org_doc'] = json_encode($post_val['org_doc']);

			}


			if ((empty($category_attachment) || empty($person_disability) || empty($photograph) || empty($signature))) {
				if (isset($error) && count($error) > 0) {
					foreach ($error as $err) {
						$this->session->set_flashdata('error', $label . "! " . $err);
						$statusre=false;
						redirect(base_url('dashboard/details'));
						//loadLayout('user/details', $data);
					}
				}
			}
			$post_val['user_id'] = $user_id;

			$post_val['application_id'] = $application_id; //'APP-'.rand();
			
			if (isset($post_val['degree_diploma']) && !empty($post_val['degree_diploma'])) {
				$post_val['degree_diploma']['file_path'] = $post_val['edu_doc'];
				$degree_diploma = $post_val['degree_diploma'];

				$this->users->insert_degree_diploma_details($user_id, $degree_diploma, $post_val['application_id']);
			}
			if (isset($post_val['work_experience']) && !empty($post_val['work_experience'])) {
				$post_val['work_experience']['file_path'] = $post_val['org_doc'];

				$experience = $post_val['work_experience'];
				$this->users->insert_work_experience_details($user_id, $experience, $post_val['application_id']);
			}

			unset($post_val['old_category_attachment']);
			unset($post_val['old_person_disability']);
			unset($post_val['old_photo']);
			unset($post_val['old_sign']);
			unset($post_val['old_adhar_card_doc']);
			unset($post_val['old_dob_doc']);
			unset($post_val['validate']);
			unset($post_val['degree_diploma']);
			unset($post_val['work_experience']);
			if (empty($person_disability)) {
				unset($post_val['person_disability']);
			}
			if (empty($photograph)) {
				unset($post_val['photograph']);
			}
			if (empty($signature)) {
				unset($post_val['signature']);
			}
			// echo $post_val['old_photo'];
			// echo $post_val['old_sign'];
			// die();
			//$post_val['userid'] = $user_id;
			$post_val['post_id'] = $this->input->post('post_id');
			$post_val['status_id'] = 6;
			// echo '<pre>';
			// print_r($post_val);
			// echo '</pre>';  
			// die;
			$res= $this->users->insert_update_user_details($post_val);

			// if(isset($candidateorganization) && $candidateorganization== 'Yes'){
			// 	$statusre=true;
			// 	redirect(base_url('dashboard/preview'));
			// }
		//   	print_r($res);die();

        //    print_r($post_val); die();
		  
			redirect(base_url('dashboard/preview'));
		  
			
			// else{
			// 	$this->users->insert_update_user_details($post_val);
			// 	redirect( base_url('dashboard/preview'));
			// 	}


		}
		if ($user_id != 0 && $application_id != null) {
			$data['user_details']  = $this->users->get_user_details($application_id);
			$data['work_experience']  = $this->users->get_user_work_experience($application_id);

			//pr($data['user_qual']);die;

		}
		if (empty($degree_diploma) && !empty($_POST['degree_diploma'])) {
			$post_count = count($_POST['degree_diploma']['deg']);
			for ($i = 0; $i < $post_count; $i++) {
				$ind = $i + 1;
				$post_degree = array(
					'deg' => $_POST['degree_diploma']['deg'][$ind],
					'year' => $_POST['degree_diploma']['year'][$ind],
					'sub' => $_POST['degree_diploma']['sub'][$ind],
					'uni' => $_POST['degree_diploma']['uni'][$ind],
					'div' => $_POST['degree_diploma']['div'][$ind],
					'per' => $_POST['degree_diploma']['per'][$ind]
				);
				$post_degree['deg_error'] =  empty($post_degree['deg']) ? 'The Degree/Diploma field is required.' : '';
				$post_degree['year_error'] = empty($post_degree['year']) ? 'The Board/University field is required.' : '';
				$post_degree['sub_error'] = empty($post_degree['sub']) ? 'The Year of Passing field is required.' : '';
				$post_degree['uni_error'] = empty($post_degree['uni']) ? 'The Max Marks field is required.' : '';
				$post_degree['div_error'] = empty($post_degree['div']) ? 'The Percentage/Marks Obtained field is required.' : '';
				$degree_diploma[] = (object)$post_degree;
			}
			$edu_file_index = 0;
			foreach ($_FILES['education_file']['name']['education_file'] as $edu_file_name) {
				if (empty($edu_file_name)) {
					$degree_diploma[$edu_file_index]->file_error = 'Education file is required!';
					$edu_file_error = True;
				}
				$edu_file_index++;
			}
			$data['degree_diploma'] = $degree_diploma;
		}

		$data['user_details'] = empty($data['user_details']) ? [] : $data['user_details'];
		$data['work_experience'] = empty($data['work_experience']) ? [] : $data['work_experience'];
		$data['state_list']  = $this->db->get('tbl_states')->result();
		$data['get_job_list']  = $this->jobpost->get_list();
		$data['post_detail']  = $this->users->get_candidate($user_id);
		$data['basic_info']  = $this->users->get_basicInfo($user_id);
	
		// echo"<pre>";
		// print_r($data);
		loadLayout('user/details', $data);
	}
	public function qualifications_employer(){
		$data['user_details'] = empty($data['user_details']) ? [] : $data['user_details'];
		$data['work_experience'] = empty($data['work_experience']) ? [] : $data['work_experience'];
		loadLayout('user/qualifications_employer', $data);
	}
	public function basic_details(){
		// $this->load->library('form_validation');
		$data = null;
		$user_id = $_SESSION['USER']['user_id'];
		$post_id = isset($_COOKIE['post_id']) ? $_COOKIE['post_id'] : null;
		$data['category'] = $this->Category_model->get_list();
		$data['state_list']  = $this->db->get('tbl_states')->result();
		$data['get_job_list']  = $this->jobpost->get_list();
		$status=array(5,6);
		$id=  $this->db->select('*')->from('users_detail')->where(array('user_id'=>$user_id, 'post_id'=>$post_id))->where_in('status_id', $status)->get()->row();
		$application_id =''; 
		$status=array(5,6);
		$id=  $this->db->select('*')->from('users_detail')->where(array('user_id'=>$user_id, 'post_id'=>$post_id))->where_in('status_id', $status)->get()->row();
		$application_id ='';  
		if(empty($id)){
		    $application_id =   $this->users->get_application_id(); //die();
		   $_SESSION['application_id'] = $application_id;
		}else {
			//print_r(array('user_id' => $user_id, 'post_id' => $post_id, 'status_id' => 5));
			$this->db->select('id,application_id');
			$this->db->where(array('user_id' => $user_id, 'post_id' => $post_id));
			$this->db->order_by('id', 'DESC');
			$q = $this->db->get('users_detail');
			if ($q) {
				$u_details_app_id = $q->row();
				if (!empty($u_details_app_id)) {
					$application_id = $u_details_app_id->application_id;
					$_SESSION['application_id'] = $application_id;
					
					$_SESSION['users_detail_id'] = $u_details_app_id->id;
					$_SESSION['existing_application'] = 'Y';
				}
			}
			
			$data['user_details']  = $this->users->get_user_details($application_id);
			
			$data['post_detail']  = $this->users->get_candidate($data['user_details']->user_id);

			$data['basic_info']  = $this->users->get_basicInfo($data['user_details']->user_id);
			
			
		}
		
		$data['basic_info']  = $this->users->get_basicInfo($user_id);
		 

		loadLayout('user/basic_details', $data);
	}
	

	public function preview()
	{
		//print_r($_SESSION);
		if (!empty($_SESSION['profile_filled']) && $_SESSION['profile_filled'] == 'Y') {
			redirect('https://www.onlinesbi.sbi/sbicollect/icollecthome.htm?corpID=5451210', 'refresh');
		}
		$data = null;
		$user_id = $_SESSION['USER']['user_id'];
		//$application_id = $_SESSION['application_id'];
		$application_id = 	$this->users->get_old_application_id();

		$post_val['agree'] = $this->input->post('agree');
		$query = $this->db->query("SELECT * FROM users_detail ORDER BY id DESC LIMIT 1");
		$result = $query->result_array();
		$lasid = $result[0]['id'];
		$status_id = 5;

		if ($this->input->post()) {
			$this->form_validation->set_rules('agree', 'Agree', 'required');
		}

		
		$data['user_details']  = $this->users->get_preview_user_details($application_id);
		$catname = $data['user_details']->category_name;
		$cat_result = $this->db->from('category')->select('id')->where('category', $catname)->get()->row();
		$cat_id = $cat_result->id;
		$postid = $data['user_details']->post_id;
		$gid = $this->db->select("group_id,fee_applicable")->from('jobpost')->where('post_id', $postid)->get()->row();
		$groupid = $gid->group_id;
		$data['fee_applicable'] = $gid->fee_applicable;
		$data['fee'] = $this->db->select('fee')->from('fee')->where('cat_id', $cat_id)->where('group_id', $groupid)->get()->row();
		$data['basic_info']  = $this->users->get_basicInfo($user_id);
		$data['degree_diploma']  = $this->users->get_user_degree_diploma($application_id);
		$data['work_experience']  = $this->users->get_user_work_experience($application_id);
		$data['get_job_list']  = $this->jobpost->get_list();
		$data['post_detail']  = $this->users->get_candidate($user_id);

	if ($this->form_validation->run() != FALSE) {

		if($data['user_details']->gender == "Female"){
			
			$status_id = 7;
			$this->db->where('application_id', $application_id);
			$this->db->update('users_detail', array('status_id' => $status_id));
			$this->users->update_user_details($application_id, $post_val);
			redirect(base_url('dashboard/success'));
		}
			if($gid->fee_applicable == 1){
				if($data['fee'] == ""){
				$status_id = 7;
				$this->db->where('application_id', $application_id);
				$this->db->update('users_detail', array('status_id' => $status_id));
				$this->users->update_user_details($application_id, $post_val);
				redirect( base_url('dashboard/success'));
				}
			$this->db->where('application_id',$application_id);
			$this->db->update('users_detail', array('status_id' => $status_id));
			$this->users->update_user_details($application_id, $post_val);
			unset($_SESSION['application_id']);
			unset($_SESSION['existing_application']);
			unset($_SESSION['users_detail_id']);
			$_SESSION['profile_filled'] = 'Y';
			redirect('https://www.onlinesbi.sbi/sbicollect/icollecthome.htm?corpID=5451210', 'refresh');
		}else{
			// echo "hii333";
			$status_id = 7;
			$this->db->where('application_id', $application_id);
			$this->db->update('users_detail', array('status_id' => $status_id));
			// echo $this->db->last_query();
			// die();
			$this->users->update_user_details($application_id, $post_val);
			
			redirect( base_url('dashboard/success'));
		}
	
	}
	
		loadLayout('home/preview', $data);
	}

	public function payment()
	{
		$data = null;
		$user_id = $_SESSION['USER']['user_id'];
		//$application_id = $_SESSION['application_id'];
		$application_id = 	$this->users->get_old_application_id();
		$post_val['agree'] = $this->input->post('agree');
		$post_val['status_id'] = 5;
		if ($this->input->post()) {
			$this->form_validation->set_rules('agree', 'Agree', 'required');
			//redirect( base_url('dashboard/preview'));
		}

		if ($this->form_validation->run() != FALSE) {
			$this->users->update_user_details($user_id, $post_val);
			redirect(base_url('https://www.onlinesbi.sbi/sbicollect/icollecthome.htm?corpID=5451210'));
		}

		$data['user_details']  = $this->users->get_user_details($application_id);
		$data['basic_info']  = $this->users->get_basicInfo($user_id);
		$data['degree_diploma']  = $this->users->get_user_degree_diploma($application_id);
		$data['work_experience']  = $this->users->get_user_work_experience($application_id);
		$data['get_job_list']  = $this->jobpost->get_list();
		$data['post_detail']  = $this->users->get_candidate($user_id);
		loadLayout('home/payment', $data);
	}

	public function success()
	{
		$cid = 416;
		$senderid = 1107168187211745344;
		$data = [];
		$user_id = $_SESSION['USER']['user_id'];
		//$application_id = $_SESSION['application_id'];
		$application_id = 	$this->users->get_old_application_id();
		$data['application_id']  = $application_id;
		$data['user_details']  = $this->users->get_user_details($application_id);
		$data['basic_info']= $this->db->select('cand_mob')->from('users')->where('user_id',$user_id)->get()->row();
		$data['post_detail']= $this->db->select('post_name')->from('jobpost')->where('post_id',$data['user_details']->post_id)->get()->row();
		$postname = $data['post_detail']->post_name;
		$applicationnumber = $data['user_details']->application_id;
		$mobile = $data['basic_info']->cand_mob;
		$smscurl = 'http://117.239.183.111/SMSSend/sendSmsNormal?';
		$postDataArray = [
			"campaign_id" => 1000016,
			"cid" => $cid,
			"parm" => '{"<post>":"' . $postname . '","<appplicationumber>":"' . $applicationnumber . '"}',
			"mobile" => $mobile,
			"sender_id" => $senderid,
			"OtherApplicationRequestTime" => date('m/d/Y H:i:s')
		];
		//print_r($postDataArray);
		$data = http_build_query($postDataArray);
		//echo $data;

		$url = $smscurl . $data;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 80);

		$response = curl_exec($ch);

		if (curl_error($ch)) {
			echo 'Request Error:' . curl_error($ch);
		} else {
			$response;
		}

		curl_close($ch);
		//$this->session->unset_userdata('application_id');

		loadLayout('home/success', $data);
	}
	public function already_apply()
	{
		loadLayout('home/already_apply');
	}


	public function get_all_data($application_id)
	{
		$user_id = $_SESSION['USER']['user_id'];
		$app_id = base64_decode($application_id);
		$this->load->library('pdf');
		$result = $this->users->makepdf($app_id);
		$data['user_details'] = $result;
		$id = $result->user_id;
		$catname = $result->category_name;
		$data['degree_diploma']  = $this->users->get_user_degree_diploma($app_id);
		$data['work_experience']  = $this->users->get_user_work_experience($app_id);
		$data['post_detail']  = $this->users->get_candidate($user_id);
		$cat_result = $this->db->from('category')->select('id,category')->where('category', $catname)->get()->row();
		$cat_id = $cat_result->id;
		$data['category_name'] = $cat_result->category;
		$postid = $result->post_id;
		$gid = $this->db->select("group_id,fee_applicable")->from('jobpost')->where('post_id', $postid)->get()->row();
		$groupid = $gid->group_id;
		$data['fee_applicable'] = $gid->fee_applicable;
		$data['fee'] = $this->db->select('fee')->from('fee')->where('cat_id', $cat_id)->where('group_id', $groupid)->get()->row();
		$html = $this->load->view('pdf/pdf_data', $data, true);
		$this->pdf->createPDF($html, 'mypdf', false,"A3");

		// $this->load->view('pdf/pdf_data', $data);
	}

	public function checkdata()
	{
		$res = $this->db->from('users')->get()->result();

		// echo "<pre";
		// print_r($res);
		// echo "<br>";
		die();
	}
	public function admit_card()
	{
		
		$this->load->library('pdf');
		$data= null;
		$html = $this->load->view('user/admitcard',$data, true);
		$this->pdf->createPDF($html, 'admincard', false, "A4");
	}
	
	public function basic_details_save(){
	
		$post_val = $this->input->post();
		
			$this->form_validation->set_rules('category', 'Category', 'required');
			if ($this->input->post('category') == '1') {
				$this->form_validation->set_rules('category_name', 'Category', 'required');
				if (empty($_FILES['category_attachment']['name']) && empty($this->input->post('old_category_attachment'))) {
					$this->form_validation->set_rules('category_attachment', 'Category Attachment', 'required');
				}
			}

			$this->form_validation->set_rules('benchmark', 'Benchmark', 'required');

			if ($this->input->post('benchmark') == 'Yes') {
				if (empty($_FILES['person_disability']['name']) && empty($this->input->post('old_person_disability'))) {
					$this->form_validation->set_rules('person_disability', 'Person Disability', 'required');
				}
				if (empty($this->input->post('add_disablity'))) {
					$this->form_validation->set_rules('add_disablity', 'Enter Disability', 'required');
				}
			}

			if ($this->input->post('adhar_card_number') != '') {
				if (empty($_FILES['adhar_card_doc']['name']) && empty($this->input->post('old_adhar_card_doc'))) {
					$this->form_validation->set_rules('adhar_card_doc', 'Adhar Card Document', 'required');
					
				}
			}
			
			///$this->form_validation->set_rules('cat_doc', 'Post ID', 'required');
			$this->form_validation->set_rules('dob', 'DOB', 'required');
			$this->form_validation->set_rules('department', 'Department', 'required');
			$this->form_validation->set_rules('gender', 'Gender ', 'required');
			$this->form_validation->set_rules('department', 'Department ', 'required');
			$this->form_validation->set_rules('marital_status', 'Marital status', 'required');
			$this->form_validation->set_rules('father_name', 'Father name', 'required');
			$this->form_validation->set_rules('mother_name', 'Mother name', 'required');
			$this->form_validation->set_rules('identity_proof', 'Identity proof', 'required');
			$this->form_validation->set_rules('adhar_card_number', 'Adhar Card Number', 'required');
			$this->form_validation->set_rules('corr_address', 'Present Postal Address', 'required');
			$this->form_validation->set_rules('corr_state', 'State', 'required');
			$this->form_validation->set_rules('corr_pincode', 'Pincode', 'required');
			$this->form_validation->set_rules('perm_address', 'Permanent Address', 'required');
			$this->form_validation->set_rules('perm_state', 'Permanent State', 'required');
			$this->form_validation->set_rules('perm_pincode', 'Permanent Pincode', 'required');
			// print_r($this->form_validation->run());
			// die();
			
			// if (isset($_FILES['dob_doc']) && $_FILES['dob_doc']['name'] != '') {

			// 	$this->form_validation->set_rules('dob_doc', 'DOB Document', 'required');
			// 	$filename = str_replace(' ','_',$_FILES["dob_doc"]['name']);
			// 	$path ='dob_proof'; //die();
			// 	$input='dob_doc';
			// 	$dob_doc= $this->upload_pdf($filename,$path,$input);
			// }
			if ($this->input->post('identity_proof') == 'DL') {
				$identity_number = $this->input->post('adhar_card_number');
				if (!preg_match('/^(([A-Z]{2}[0-9]{2})( )|([A-Z]{2}-[0-9]{2}))((19|20)[0-9][0-9])[0-9]{7}$/', $identity_number)) {
					$this->session->set_flashdata('error', 'Invalid driving license.');
					  //redirect(base_url('dashboard/details'));
						//loadLayout('user/details', $data);
						$response='Invalid driving license.';
						
				}
			}

			if ($this->input->post('identity_proof') == 'Adhaar') {
				$identity_number = $this->input->post('adhar_card_number');
				if (!preg_match('/^([0-9]{4}[0-9]{4}[0-9]{4}$)|([0-9]{4}\s[0-9]{4}\s[0-9]{4}$)|([0-9]{4}-[0-9]{4}-[0-9]{4}$)/', $identity_number)) {
					$this->session->set_flashdata('error', 'Invalid Aadhar card number.');
					$response='Invalid Aadhar card number.';
				}
			}

			if ($this->input->post('identity_proof') == 'Pan') {
				$identity_number = $this->input->post('adhar_card_number');
				if (!preg_match('/([A-Z]){5}([0-9]){4}([A-Z]){1}$/', $identity_number)) {
					$this->session->set_flashdata('error', 'Invalid Pan card number.');
					$response='Invalid Pan card number.';
				}
			}

			if ($this->input->post('identity_proof') == 'Passport') {
				$identity_number = $this->input->post('adhar_card_number');
				if (!preg_match('/^[A-PR-WY][1-9]\d\s?\d{4}[1-9]$/', $identity_number)) {
					$this->session->set_flashdata('error', 'Invalid Passport number.');
					$response='Invalid Passport number.';
				}
			}

			if ($this->input->post('identity_proof') == 'Voter') {
				$identity_number = $this->input->post('adhar_card_number');
				if (!preg_match('/^[A-Z]{3}[0-9]{7}$/', $identity_number)) {
					$this->session->set_flashdata('error', 'Invalid Voter Id.');
					$response='Invalid Voter Id.';
				}
			}

		if($this->form_validation->run()){
			$array = array(
				'success' => '<div class="alert alert-success">Thank you for Contact Us</div>'
			);
		}else{
			$array = array(
				'error'   => true,
				'dob_error' => form_error('dob'),
				'dob_doc_error' => form_error('dob_doc'),
				'category_name_error' => form_error('category_name'),
				'add_disablity_error' => form_error('add_disablity'),
				'gender_error' => form_error('gender'),
				'marital_status_error' => form_error('marital_status'),
				'father_name_error' => form_error('father_name'),
				'mother_name_error' => form_error('mother_name'),
				'identity_proof_error' => form_error('identity_proof'),
				'identity_error' => form_error('adhar_card_number'),
				'corr_address_error' => form_error('corr_address'),
				'corr_state_error' => form_error('corr_state'),
				'corr_pincode' => form_error('corr_pincode'),
				'perm_address_error' => form_error('perm_address'),
				'perm_state_error' => form_error('perm_state'),
				'perm_pincode' => form_error('perm_pincode_error')
				
			);
		}

			echo json_encode($array);

	}
	public function upload_pdf($filename,$path,$input){
		      
		 $user_id=$_SESSION['USER']['user_id'];
		 $post_id=$_COOKIE['post_id'];
		
		        $file_name = str_replace(' ','_',$filename);
				
				$unlink ='uploads/'.$path.'/'.$user_id."_".$post_id."_".$file_name; //die();
				
				if (file_exists($unlink)) {
					unlink($unlink);
				}
				$config['upload_path'] = 'uploads/'.$path.'/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1024';
				$config['file_name'] = $user_id."_".$post_id."_".$file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload($input)) {
					$upload_data = $this->upload->data();
					$dob_doc = $upload_data['file_name'];
				   return   $user_id."_".$post_id."_".$file_name;
				} else {
					$error = array('error' => $this->upload->display_errors());
					//$label = "Date Of Birth Document";
				}

	}
}
