<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);

?>
<div class="btn offbtn">
<a href="<?php echo base_url() . "user/logout"; ?>"">Logout</a>
    </div>
    
    <a href="<?php echo base_url() . "dashboard/UserDashboard"; ?>"" style="float:left; margin-left:100px;">Dashboard</a>
<div class="contact-page-area container-fluid padding-bottom">
    <?php $this->load->view('common/user_tab.php');
                        /*$month = date('m');
                        
                        if($month<7){
                            $date = strtotime('2023-07-01 -1 year');
                            $last_date =  date('d-m-Y', $date);
                        }else{
                            $last_date=date("01-07-Y");
                        }
						
						$dob_age="";
						if(isset($user_details->dob)&&!empty($user_details->dob)){
							$dob_age=cal_diff_in_ymd_format($user_details->dob,$last_date);
                            
						}*/
                        //ALok
                        $dob_array = explode('-',$user_details->dob);
                        $dobdate = (int) $dob_array[2];
                        $dobmonth = (int) $dob_array[1]-1;
                        $dobyear = (int) $dob_array[0];
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
                            $yyyy = (int)date('Y');    
            
                        }
                        $last_date = '01-07-'.$yyyy; 
                        $calculated_year = $yyyy-$dobyear;
                        $dob_age = $calculated_year;
                        $dob_age .= $calculated_year>1?' Years ':' Year ';
                        $dob_age .=$calculated_month;
                        $dob_age .= $calculated_month>1?' Months ':' Month ';
                        $dob_age .=$calculated_days;
                        $dob_age .= $calculated_days>1?' Days':' Day';
                        
                        ?>


    <div class="container">
        <div id="national_form" class="container" style="text-align: center">

            <div class="panel panel-info national_form_border">

                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%">

                        <form method="post" id="notification-form" action="dashboard/preview/" enctype="multipart/form-data" novalidate="novalidate">
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />    
                        <table class="table table-bordered" id="tbl_Candidate">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align: left; width: 100%;">
                                            <table align="left" class="table table-bordered" style="width: 100%" id="tblcndt">
                                                <tbody>
                                                    <tr>
                                                       
                                                        <th style="width: 40%;">Registration Number</th>
                                                        <th style="width: 40%;"><?php echo set_value('registration_number', @$basic_info->registration_number);?></th>
                                                        <th rowspan="5" align="center"><img src="<?= base_url('uploads/photograph/').@$user_details->photograph; ?>" alt="user" class="img-responsive" style="width:150px; margin: 0 auto;"></th>
                                                    </tr>
                                                    <tr>
                                                        <td>Full Name</td>
                                                        <td><?php echo set_value('first_name', @$basic_info->first_name);?> <?php echo set_value('middel_name', @$basic_info->middel_name);?> <?php echo set_value('last_name', @$basic_info->last_name);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Name of the Post Applied for</td>
                                                        <td>
														<?php $post_id= set_value('post_id', @$user_details->post_id);?>
														<?php
														   if(isset($get_job_list)&&!empty($get_job_list)){
															foreach($get_job_list as $value){
															if($value->post_id==$post_id){
																echo set_value('post', @$value->post_name);}
																}
																}?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Category</td>
                                                        <td><?php $category = set_value('category', @$user_details->category);
														if($category=='1'){
															echo 'Yes';
														}else{
															echo 'No';
														}?>
														<?php if(!empty($user_details->category)&&$user_details->category=='1'){?>
															<a href="<?= base_url('uploads/category_attachment/').@$user_details->category_attachment; ?>" target="_blank" class="btn btn-info" style="background-color:#46b8da;">View</a>
														<?php }?></td>
                                                    </tr>
                                                    <tr>
                                
                                                        <td>Is Candidate belongs to Department?</td>
                                                        <td><?php $Department = set_value('Department', @$user_details->department);
														if($Department=='1'){
															echo 'NIHFW';
														}if($Department=='0'){
                                                            echo 'Other';
                                                        }
                                                        if($Department=='2'){
															echo 'No';
														}?>
														
                                                    </tr>
													

                                                    <tr>
                                                        <td>Are you a person with benchmark disability of 40% and above?</td>
                                                        <td><?php echo set_value('benchmark', @$user_details->benchmark);?></td>
                                                    </tr>
													<?php if(!empty($user_details->benchmark)&&$user_details->benchmark=='Yes'){?>
                                                    <tr>
                                                        <td>Whether person with disability</td>
                                                        <td><a href="<?= base_url('uploads/person_disability/').@$user_details->person_disability; ?>" target="_blank" class="btn btn-info" style="background-color:#46b8da;">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Disability Details</td>
                                                        <td><?php echo set_value('add_disablity', @$user_details->add_disablity);?></td>
                                                    </tr>
													<?php }?>

                                                </tbody>
                                            </table>


                                        </td>
                                    </tr>

                                    <tr class="bg-info">
                                        <td colspan="2" class="heading2">
                                            <span>Personal Details ↓ </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" style="text-align: left; width: 100%;">
                                            <table align="left" class="table table-bordered" style="width: 100%" id="tblcndt">
                                                <tbody>
                                                    <tr><?php

                                                    $dobformat = $user_details->dob;
                                                    $dob = date("d-m-Y", strtotime($dobformat));
                                                    ?>
                                                        <td align="left" style="width: 30%;">Date Of Birth (DD-MM-YYYY)</td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('dob', $dob);?>
                                                       <a href="<?= base_url('uploads/dob_proof/').@$user_details->dob_doc; ?>" target="_blank" class="btn btn-info" style="background-color:#46b8da;">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="width: 30%;">Age completed as on <?php echo $last_date;?></td>
                                                        <td align="left" style="width: 70%;"><?php echo $dob_age; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="width: 30%;">Gender</td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('gender', @$user_details->gender);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="width: 30%;">Marital Status</td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('marital_status', @$user_details->marital_status);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="width: 30%;">Father's Name</td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('father_name', @$user_details->father_name);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="width: 30%;">Mother's Name</td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('mother_name', @$user_details->mother_name);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="width: 30%;">Identity Proof</td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('identity_proof', @$user_details->identity_proof);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="width: 30%;">Identity Number</td>
                                                        <?php 
                                                        $adhar_card_number =  str_pad(substr($user_details->adhar_card_number, -4), strlen($user_details->adhar_card_number), '*', STR_PAD_LEFT);
                                                        ?>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('adhar_card_number', $adhar_card_number);?><a href="<?= base_url('uploads/adhar_card_doc/').@$user_details->adhar_card_doc; ?>" target="_blank" class="btn btn-info" style="background-color:#46b8da; margin: 0 0 0 4px;">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="width: 30%;">Present postal Address</td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('corr_address', @$user_details->corr_address);?></td>
                                                    </tr>
                                                    <tr>
                                                    <?php
                                                    $this->db->where('id', $user_details->corr_state);
                                                    $q = $this->db->get('tbl_states');
				                                    $datastate = $q->result_array();
                                                    ?>
                                                        <td align="left" style="width: 30%;">State </td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('corr_state', $datastate[0]['name']);?></td>
                                                    </tr>

                                                    <tr>
                                                        <td align="left" style="width: 30%;">Pincode</td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('corr_pincode', @$user_details->corr_pincode);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="width: 30%;">Permanent Address</td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('perm_address', @$user_details->perm_address);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="width: 30%;">State </td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('perm_state', $datastate[0]['name']);?></td>
                                                    </tr>

                                                    <tr>
                                                        <td align="left" style="width: 30%;">Pincode</td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('perm_pincode', @$user_details->perm_pincode);?></td>
                                                    </tr>

                                                    <tr>
                                                        <th colspan="2">Contact Details</th>
                                                    </tr>

                                                    <tr>
                                                        <td align="left" style="width: 30%;">Mobile No.</td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('cand_mob', @$basic_info->cand_mob);?></td>
                                                    </tr>

                                                    <tr>
                                                        <td align="left" style="width: 30%;">Email ID</td>
                                                        <td align="left" style="width: 70%;"><?php echo set_value('cand_email', @$basic_info->cand_email);?></td>
                                                    </tr>
                                                </tbody>
                                            </table>


                                        </td>
                                    </tr>

                                    <tr class="bg-info">
                                        <td colspan="2" class="heading2">
                                            <span>Details of Educational and other professional / Technical qualifications ↓ </span>
                                            <input type="hidden" name="trow" id="tq" value="5">
                                        </td>
                                    </tr>

                                    <tr style="font-size: 12pt">
                                        <td colspan="2" style="text-align: left">
                                            <div style="text-align: left">
                                                <table id="dynamic_field" class="table table-bordered" style="width: 100%">
                                                    <tbody>
                                                        <tr class="bg-danger">
                                                            <!-- <td align="left" style="font-weight: Medium; color: white;" valign="top">Sr no.</td> -->
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Examination/Degree and Subjects</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Board/ University</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Year of Passing</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Max. Marks</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Marks Obtained</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Percentage</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Certificate / Mark Sheet</td>
                                                        </tr>
														<?php 
                                                        $i=1;
                                                        $k = 0;
                                                        
                                                        
                                                        $edufiles = json_decode($user_details->edu_doc);
                                                        
                                                            //$edufiles
														if(!empty($degree_diploma)){
                                                        foreach($degree_diploma as $value){
                                                            
                                                            ?>
                                                        <tr>
                                                            <!-- <td align="left"><?php //echo $i;?></td> -->
                                                            <td align="left"><?php echo set_value('deg',@$value->deg); ?></td>
                                                            <td align="left"><?php echo set_value('year',@$value->year); ?></td>
                                                            <td align="left"><?php echo set_value('sub',@$value->sub); ?></td>
                                                            <td align="left"><?php echo set_value('uni',@$value->uni); ?></td>
                                                            <td align="left"><?php echo set_value('div',@$value->div); ?></td>
                                                            <td align="left"><?php echo set_value('per',@$value->per); ?></td>
                                                            <?php /*
                                                            <td><?php if(!empty($edufiles)){ ?><a href="<?= base_url('uploads/education_proof/').$edufiles[$k]; ?>" target="_blank" class="btn btn-info" style="background-color:#46b8da;">View</a><?php } ?></td>
                                                            
                                                            */?>
                                                            <td><?php if(!empty(@$value->file_path)){ ?><a href="<?= base_url('uploads/education_proof/').@$value->file_path; ?>" target="_blank" class="btn btn-info" style="background-color:#46b8da;">View</a><?php } ?></td>
                                                        </tr>
														<?php
                                                        $k++;
                                                        $i++; }}  ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="bg-info">
                                        <td colspan="2" class="heading2">
                                            <span>Work Experience details (Start from present Employer) ↓ </span>
                                        </td>
                                    </tr>

                                    <tr style="font-size: 12pt">
                                        <td colspan="2" style="text-align: left">
                                            <div style="text-align: left">
                                                <table id="dynamic_field" class="table table-bordered" style="width: 100%">
                                                    <tbody>
                                                        <tr class="bg-danger">
                                                        <!-- <td align="left" style="font-weight: Medium; color: white;" valign="top">Sr No.</td> -->
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Organization</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Post held</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Pay Scale and Basic Pay</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">From</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">To</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Appointment Order</td>
                                                        </tr><?php 
                                                        $i=1;
                                                        $k = 0;
                                                        $orgfiles = json_decode($user_details->org_doc);
														$user_work_experience=@$work_experience;
                                                        if(!empty($user_work_experience[0]->organization)){
														if(isset($user_work_experience)){
                                                        foreach($user_work_experience as $value){?>
                                                        <tr>
                                                        <!-- <td align="left"><?php //echo $i;?></td> -->
                                                            <td align="left"><?php echo set_value('organization',@$value->organization);?></td>
                                                            <td align="left"><?php echo set_value('post_held',@$value->post_held); ?></td>
                                                            <td align="left"><?php echo set_value('pay_scale',@$value->pay_scale); ?></td>
														    <td align="left"><?php   if(strtotime($value->from_date) == '-62170005208'){}else{ echo set_value('from_date',date("d-m-Y",strtotime(date_convert_normal_to_mysql($value->from_date))));} ?></td>
                                                            <td align="left"><?php if(strtotime($value->to_date) == '-62170005208'){}else{ echo set_value('to_date',date("d-m-Y",strtotime(date_convert_normal_to_mysql($value->to_date))));} ?></td>
                                                            <?php /*<td><?php if(!empty($orgfiles)){ ?><a href="<?= base_url('uploads/education_proof/').$orgfiles[$k]; ?>" target="_blank" class="btn btn-info" style="background-color:#46b8da;">View</a><?php } ?></td>
                                                       */?>
                                                       <td><?php if(!empty(@$value->file_path)){ ?><a href="<?= base_url('uploads/education_proof/').@$value->file_path; ?>" target="_blank" class="btn btn-info" style="background-color:#46b8da;">View</a><?php } ?></td>
                                                         </tr>
														<?php
                                                        $k++;
                                                        $i++; }} } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr style="font-size: 12pt">
                                        <td colspan="2" style="text-align: left">
                                            <div id="" style="width:100%;">
                                                <table style="width: 100%" class="table table-bordered">

                                                    <tbody>

                                                        <tr>
                                                            <td align="left" style="width: 30%;">
                                                            Fee	

                                                            </td>
                                                            <td align="left" style="width: 70%;"><?php
                                                            if($user_details->gender == "Female"){
                                                                echo "Exempted";
                                                            }else{
                                                                if($fee_applicable == 1){
                                                                if($fee == ""){
                                                                echo "Exempted";
                                                                }else{
                                                            echo $fee->fee; }
                                                                }else{
                                                                    echo "Exempted";
                                                                }
                                                            }
                                                           ?>
                                                            </td>
                                                        </tr>
                                                        

                                                    </tbody>
                                                </table>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="font-size: 12pt">
                                        <td style="text-align: left;">
                                            <b>Declaration:</b><br /> I hereby declare that I am a citizen of India. The entries in this application form are complete, true and correct to the best of my knowledge and belief. I have read carefully all the examination rules and provisions related to this advertisement and I promise to follow these and also promise that I will not use any unfair means during examination.<br><br>
                                            I fulfil all the eligibility criteria i.e. age limit, educational qualification today as prescribed in the advertisement. I have all the eligibility certificates, whenever the NIHFW will ask for it I will produce the same failing which my candidature can be cancelled by the NIHFW at any time. In case of any information provided by me found to be false or Incorrect before or after the examination, the NIHFW can cancel my candidature. I declare that I have filled only one application form for this examination.<br /><br /><input type="checkbox" name="agree" <?php if(@$user_details->agree=='1'){?> checked <?php }?> value="1"> I Agree
                                                        <span class="form_error"><?php echo form_error('agree'); ?></span></td>

                                        <th align="right" style="width: 20%;">
                                            <img src="<?= base_url('uploads/signature/').@$user_details->signature; ?>" alt="user" class="img-responsive" style="width:100px; margin: 0 auto;">
                                        </th>
                                    </tr>
                                    <?php 
                                    date_default_timezone_set('Asia/kolkata');
                                    $currentDatetime= date('m/d/Y H:i:s');
                                    $newDateTime = date('h:i A', strtotime($currentDatetime));
                                    ?>
                                    <tr>
                                        <td colspan="2"><b>Date:</b> <?php echo date("d-m-Y ").' '. $newDateTime;?></td>
                                    </tr>
                                    <tr class="bg-info">
                                    <td colspan="2" class="heading2">
                                        <span>Payment ↓ </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="background: #fff; font-size: 15px; color: red;">Your payment status will be updated within 48 Hours.
Kindly do not apply again.</td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered" id="Table1">
                                <tbody>
                                    <tr class="bg-info">
                                        <td colspan="2" style="text-align: center;">
                                            <input type="submit" name="" value="Final Submit" onclick="" id="" class="btn btn-success" style="font-weight:bold;width:250px;">
                                            &nbsp;<!--<input type="submit" name="" value="Back" id="" class="btn btn-warning" style="width:150px;">--><a href="<?php echo base_url() . "dashboard/details"; ?>" class="btn btn-warning" style="width:150px;">Edit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                    </div>
                </div>

            </div>
        </div>
        <!-- Main body End Here -->
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/additional-methods.js"></script>