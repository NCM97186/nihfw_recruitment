<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
?>
<div class="btn offbtn">
    <a href="<?php echo base_url() . "user/logout"; ?>"">Logout</a>
    </div>
    &nbsp;&nbsp;&nbsp;<a href=" <?php echo base_url() . "dashboard/UserDashboard"; ?>"" style="float:left; margin-left:100px;">Dashboard</a>
    <div class="contact-page-area container-fluid padding-bottom">
        <?php $this->load->view('common/user_tab.php');  ?>
        <?php $this->load->view('common/messages.php'); ?>
        <div class="container">
            <div id="national_form" class="container" style="text-align: center">
            <div class="alert alert-danger print-error-msg" style="display:none"></div>
                <div class="panel panel-info national_form_border">

                    <div class="panel-body">
                        <div id="" style="text-align: left; background-color: White; width: 100%">
                            <?php
                            $attributes = array('name' => 'details_form', 'id' => 'details_forms', 'onsubmit' => "return SubmitForm()");
                            $action =   base_url() . "dashboard/basic_details/";
                          //  $action = '#';
                            $last_date = date("01-07-Y");
                            // if(isset($last_date)){
                            // $last_date=$post_detail->last_date;
                            // }
                            // echo $last_date;
                            // die();
                            $dob_age = "";
                            if (isset($user_details->dob) && !empty($user_details->dob) && !empty($last_date)) {
                                $dob_age = cal_diff_in_ymd_format($user_details->dob, $last_date);
                            }
                          // echo form_open_multipart($action, $attributes);
                            if (isset($user_details->id)) {
                                $detailId = $user_details->id;
                            } else {
                                $detailId = '';
                            }
                           
                            ?>
                           <form name="details_form" id="details_forms" action="javascript:void(0)"  enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
                           <!--   <input type="hidden" name="detailId" value="<?php echo $detailId ?>">-->
                            <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
                        
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="bg-info">
                                        <td colspan="2" class="heading2">
                                            <span>Basic Details ↓ </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" style="text-align: left; width: 100%;">
                                            <table align="left" class="table table-bordered" style="width: 100%" id="tblcndt">
                                                <tbody>
                                                    <tr>
                                                        <td align="right" style="width:25%;">

                                                        <span>Name of the Post Applied for</span><span style="font-size: medium; color: #CC0000"></span>
                                                        </td>
                                                        <td align="left" style="width: 20%;">
                                                            <?php $post_id = set_value('post_id', $_COOKIE['post_id']); ?>
                                                            <select name="post_id" class="form-control" disabled style="width: 40%;">

                                                                <?php
                                                                if (isset($get_job_list) && !empty($get_job_list)) {
                                                                    $postid = $_COOKIE['post_id'];
                                                                    $this->db->where('post_id', $postid);
                                                                    $jobpost =  $this->db->get('jobpost');
                                                                    $dataj = $jobpost->result_array();
                                                                    
                                                                ?>
                                                                    <option value="<?php echo $dataj[0]['post_id']; ?>"><?php echo $dataj[0]['post_name']; ?> </option>
                                                                <?php
                                                                }
                                                                
                                                                ?>
                                                            </select>
                                                            
                                                             <span id="post_id_error" class="form_error"></span>
                                                        </td>
                                                        <td align="left" style="width: 30%;">

                                                            <span>Name of Candidate in full</span><span style="font-size: medium; color: #CC0000"></span>
                                                        </td>
                                                        <td align="left" style="width: 25%;">
                                                            <?php echo set_value('first_name', @$basic_info->first_name); ?> <?php echo set_value('middel_name', @$basic_info->middel_name); ?> <?php echo set_value('last_name', @$basic_info->last_name); ?>
                                                        
                                                            <input name="name" type="hidden" value="<?php echo set_value("name", $basic_info->first_name." ".$basic_info->middel_name." ".$basic_info->last_name); ?>">
                                                        </td>
                                                    </tr>

                                                   
                                                    <tr>
                                                        <td align="right" style="">
                                                            <span id="">Date Of Birth (DD-MM-YYYY) </span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="">
                                                            <div class="form-inline">
                                                                <?php if(isset($_POST['dob'])){
                                                                            $do=$_POST['dob'];
                                                                        } else{
                                                                            $do="";
                                                                        }
                                                                        $dob=!empty(@$user_details->dob)?@$user_details->dob:$do; 

                                                                        $dob_array = explode('-',!empty($dob)?$dob:'0000-00-00');
                                                                        $date =  (int) $dob_array[2];
                                                                        $month = (int) $dob_array[1]-1;
                                                                        $years = (int) $dob_array[0];
                                                                        ?>
                                                                <input type="date" name="dob" id="dob" class="form-control" value="<?php echo set_value('dob', @$dob); ?>">
                                                                <span style="color:Black;font-family:Times New Roman;font-weight:normal;"></span>
                                                                <br>
                                                                <em><span style="color: #7d7e7f; font-size:13px">( Please Select your DOB As given in Matriculation Certificate.
                                                                        )</span></em>
                                                                <span class="form_error"><?php echo form_error('dob'); ?></span>
                                                                <span id="dob_error" class="form_error"></span>
                                                            </div>
                                                            <input type="hidden" name="old_dob_doc" value="<?php echo @$user_details->dob_doc; ?>">
                                                            <input type="file" name="dob_doc" id="dob_doc" onchange="onlyDobpdf(this);" />
                                                            <span class="form_error"><?php echo form_error('dob_doc'); ?></span>

                                                            <span class="dob_doc_error" style="color:red;"></span>
                                                            <span style="font-size:13px">Please select pdf format file<br>Max file size 1 MB</span>
                                                        </td>

                                                        <td align="left" style="">

                                                            <span>Whether belongs to SC/ST/OBC(as per central government list)/EWS if so, specify the category</span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="">
                                                        <?php 
                                                            if(isset($_POST['category'])){
                                                                $cat=$_POST['category'];
                                                            } else{
                                                                $cat="";
                                                            }
                                                            $category1=!empty(@$user_details->category)?@$user_details->category:$cat; 
                                                        ?>
                                                            <?php $category = set_value('category', @$category1); ?>
                                                            <select name="category" id="categorys" class="form-control" style="width: 40%;" required onchange="categories()">
                                                                <option value="2" <?php if ($category == '2') { ?> selected <?php } ?>>No</option>
                                                                <option value="1" <?php if ($category == '1') { ?> selected <?php } ?>>Yes</option>

                                                            </select>

                                                            <span class="form_error"><?php echo form_error('category'); ?></span>
                                                            <br />
                                                            <table class="" id="a1" name="category_proof" style="display:none;">
                                                                <tr>
                                                                    <td align="left" style="">
                                                                        <!-- <input type="radio" name="category_name" value="GENERAL" <?php // echo set_radio('category', 'GENERAL'); 
                                                                                                                                        ?>> GENERAL 
                                                        <input type="radio" name="category_name" value="EWS" <?php //echo set_radio('category', 'EWS'); 
                                                                                                                ?>> EWS-->
                                                         <?php 
                                                            if(isset($_POST['category_name'])){
                                                                $cat_name=$_POST['category_name'];
                                                            } else{
                                                                $cat_name="";
                                                            }
                                                            $category_name1=!empty(@$user_details->category_name)?@$user_details->category_name:$cat_name; 
                                                        ?>

                                                                        <?php $category_name = set_value('category_name', @$category_name1); ?>
                                                                        <input type="radio" name="category_name" value="OBC" <?php if ($category_name == 'OBC') { ?> checked <?php } ?> <?php //echo set_radio('category', 'OBC'); 
                                                                                                                                                                                        ?>> OBC
                                                                        <input type="radio" name="category_name" value="ST" <?php if ($category_name == 'ST') { ?> checked <?php } ?> <?php //echo set_radio('category', 'ST'); 
                                                                                                                                                                                        ?>> ST
                                                                        <input type="radio" name="category_name" value="SC" <?php if ($category_name == 'SC') { ?> checked <?php } ?> <?php //echo set_radio('category', 'SC'); 
                                                                                                                                                                                        ?>> SC
                                                                        <input type="radio" name="category_name" value="EWS" <?php if ($category_name == 'EWS') { ?> checked <?php } ?> <?php //echo set_radio('category', 'SC'); 
                                                                                                                                                                                    ?>> EWS
                                                                        <!-- <input type="radio" name="category" value="OH" > OH -->
                                                                        <!-- <?php //$category_name = set_value('category_name', @$user_details->category_name); 
                                                                                ?>
                                                  <?php  //foreach($category as $value) { 
                                                    ?>
                                                            


                                                   <input type="radio" name="category_name" value="<?php // echo $value->id;
                                                                                                    ?>" <?php //if($category_name  == $value->id) { echo 'checked'; }  
                                                                                                        ?>
                                                            >> <?php //echo $value->category;
                                                                ?> 
                                                           
                                  <?php //} 
                                    ?>
                                                        <span class="form_error"><?php //echo form_error('category_name'); 
                                                                                    ?></span>
														 </td></tr> -->


                                                                <tr>
                                                                    <td align="left" style="">
                                                                        <span style="font-size:13px">(Self Attested copy of latest certificate to be attached):</span>

                                                                        <input type="hidden" name="old_category_attachment" value="<?php echo @$user_details->category_attachment; ?>">
                                                                        <input type="file" onchange="onlyCatpdf(this);" name="category_attachment" id="cat_doc" />
                                                                        <span class="form_error"><?php echo form_error('category_attachment'); ?></span>
                                                                        <span class="cat_doc_error" style="color:red;"></span>
                                                                        <span style="font-size:13px">Please select pdf format file<br>max file size 1MB</span>
                                                                    </td>
                                                                </tr>
                                                            </table>


                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td align="right" style="">
                                                            Age as on <span id="dob_calcdate"> </span> <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>

                                                        </td>
                                                        <td align="left" style="">
                                                            <div class="form-inline" id="cand_age"> <?php  echo  age_calculate($date, $month, $years) ; ?></div>
                                                            <?php if(isset($_POST['candtotal_age'])){
                                                                            $candtotal_age=$_POST['candtotal_age'];
                                                                        } else{
                                                                            $candtotal_age="";
                                                                        }
                                                                        $candtotalsss=!empty(@$user_details->candtotal_age)?@$user_details->candtotal_age:$candtotal_age; ?>
                                                            <input type="hidden" name="candtotal_age" id="candtotal_age" value="<?php echo $candtotalsss; ?>" />
                                                           
                                                           <!-- <input type="checkbox" name ="age_calculator" id="age_calculator" /> Please checked here for Age Calculation
                                                                    --><span class="form_error"><?php echo form_error('age_calculator'); ?></span>
                                                        </td>

                                                        <td align="left" style="">
                                                            <span>Is Candidate belongs to NIHFW?</span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="">
                                                        <?php 
                                                            if(isset($_POST['department'])){
                                                                $dep=$_POST['department'];
                                                            } else{
                                                                $dep="";
                                                            }
                                                            $department1=!empty(@$user_details->department)?@$user_details->department:$dep; 
                                                        ?>
                                                            <?php $department = set_value('department', @$department1); ?>
                                                            <select name="department" id="department" class="form-control" style="width: 40%;">
                                                                <option value="2" <?php if ($department == '2') { ?> selected <?php } ?>>No</option>
                                                                <option value="1" <?php if ($department == '1') { ?> selected <?php } ?>>YES</option>
                                                                <!-- <option value="1" <?php //if($department=='0'){
                                                                                        ?> selected <?php //}
                                                                                                    ?>>Other</option> -->

                                                            </select>
                                                            <span class="form_error"><?php echo form_error('category'); ?></span>
                                                            <br />
                                                        </td>
                                                    </tr>
                                                   
                                                    <!-- <tr>
                                                    <td colspan="2" style="background: #fff; font-size: 13px; color: #6969de;">No change in category will be permitted after final submission of your application.</td>
                                                </tr> -->
                                                    <tr>
                                                        <td colspan="2" align="right" style="">
                                                            <span id="">Are you a person with benchmark disability of 40% and above? </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>

                                                        </td>
                                                        <td colspan="2" align="left" style="">
                                                        <?php 
                                                            if(isset($_POST['benchmark'])){
                                                                $ben=$_POST['benchmark'];
                                                            } else{
                                                                $ben="";
                                                            }
                                                            $benchmark1=!empty(@$user_details->benchmark)?@$user_details->benchmark:$ben; 
                                                        ?>
                                                            <?php 
                                                            
                                                            $benchmark = set_value('benchmark', @$benchmark1); ?>
                                                            <input name="benchmark" id="benchmark_yes" class="benchmark" type="radio" value="Yes" <?php if ($benchmark == 'Yes') { ?> checked <?php } ?>> Yes
                                                            <input name="benchmark" id="benchmark_no" class="benchmark" type="radio" value="No" <?php if ($benchmark == 'No') { ?> checked <?php } ?>> No
                                                            <span class="form_error"><?php echo form_error('benchmark'); ?></span>
                                                            <table class="" id="a2" name="disability_proof" style="display:none;">
                                                                <tr>
                                                                    <td align="left" style="">
                                                                        <span id="" style="font-size:13px">Whether person with disability (enclosed self-attested copy of certificate)</span><span style="font-size: medium; color: #CC0000"><?php if (!empty($user_details->person_disability)) { ?><strong>*</strong><?php } ?></span>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" style="">
                                                                        <span>Disability Details</span>
                                                                    <?php 
                                                                        if(isset($_POST['add_disablity'])){
                                                                            $add_dis=$_POST['add_disablity'];
                                                                        } else{
                                                                            $add_dis="";
                                                                        }
                                                                        $add_disablity1=!empty(@$user_details->add_disablity)?@$user_details->add_disablity:$add_dis; 
                                                                    ?>
                                                                        <input style="margin-top:5px; margin-bottom:5px;" name="add_disablity" type="text" value="<?php echo set_value("add_disablity", @$add_disablity1); ?>">
                                                                        <span class="form_error"><?php echo form_error('add_disablity'); ?></span>
                                                                     <?php 
                                                                        if(isset($_POST['person_disability'])){
                                                                            $person_dis=$_POST['person_disability'];
                                                                        } else{
                                                                            $person_dis="";
                                                                        }
                                                                        $person_disability1=!empty(@$user_details->person_disability)?@$user_details->person_disability:$person_dis; 
                                                                    ?>

                                                                        <input type="hidden" name="old_person_disability" value="<?php echo @$person_disability1; ?>">
                                                                        <input type="file" onchange="onlyDisablitypdf(this);" name="person_disability" id="person_disability" class="form-control" style="width: 100%;" />
                                                                        <span class="form_error"><?php echo form_error('person_disability'); ?></span>
                                                                        <span class="person_disability_error" style="color:red;"></span>
                                                                        <span style="font-size:13px">Please select pdf format file<br>max file size 1MB</span>

                                                                    </td>

                                                                </tr>
                                                            </table>
                                                        </td>

                                                    </tr>
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

                                                    <!-- <tr>
                                                    <td colspan="2" style="background: #fff; font-size: 13px; color: #6969de;">NOTE: Please ensure you have already filled in the details under Basic Details in the Online Form especially pertaining to category. Change in Date of Birth will not be permitted</td>
                                                </tr> -->

                                                    <tr>
                                                        <td align="right" style="width: 25%;">
                                                            <span id="">Gender </span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <?php 
                                                            if(isset($_POST['gender'])){
                                                                $gre=$_POST['gender'];
                                                            } else{
                                                                $gre="";
                                                            }
                                                            $gender1=!empty(@$user_details->gender)?@$user_details->gender:$gre; 
                                                        ?>
                                                        <td align="left" style="width: 25%;">
                                                            <?php $gender = set_value('gender', @$gender1); ?>
                                                            <input name="gender" type="radio" value="Male" <?php if ($gender == 'Male') { ?> checked <?php } ?>> Male
                                                            <input name="gender" type="radio" value="Female" <?php if ($gender == 'Female') { ?> checked <?php } ?>> Female
                                                            <input name="gender" type="radio" value="Others" <?php if ($gender == 'Others') { ?> checked <?php } ?>> Others
                                                            <span class="form_error"><?php echo form_error('gender'); ?></span>
                                                        </td>
                                                        
                                                        <td align="left" style="width: 25%;">
                                                            <span id="">Marital Status </span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 25%;">
                                                        <?php 
                                                            if(isset($_POST['marital_status'])){
                                                                $mar=$_POST['marital_status'];
                                                            } else{
                                                                $mar="";
                                                            }
                                                            $marital_status1=!empty(@$user_details->marital_status)?@$user_details->marital_status:$mar; 
                                                        ?>
                                                            <?php $marital_status = set_value('marital_status', @$marital_status1); ?>
                                                            <input name="marital_status" type="radio" value="Unmarried" <?php if ($marital_status == 'Unmarried') { ?> checked <?php } ?>> Unmarried
                                                            <input name="marital_status" type="radio" value="Married" <?php if ($marital_status == 'Married') { ?> checked <?php } ?>> Married
                                                            <input name="marital_status" type="radio" value="Widow" <?php if ($marital_status == 'Widow') { ?> checked <?php } ?>> Widow <br>
                                                            <input name="marital_status" type="radio" value="Widower" <?php if ($marital_status == 'Widower') { ?> checked <?php } ?>> Widower
                                                            <input name="marital_status" type="radio" value="Divorced" <?php if ($marital_status == 'Divorced') { ?> checked <?php } ?>> Divorced
                                                            <!-- <input name="marital_status" type="radio" value="Judicially Separated" <?php if ($marital_status == 'Judicially Separated') { ?> checked <?php } ?>> Judicially Separated -->
                                                            <span class="form_error"><?php echo form_error('marital_status'); ?></span>
                                                        </td>
                                                   
                                                    <tr>
                                                        <td align="right" style="">
                                                            <span id="">Father's Name </span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <?php 
                                                            if(isset($_POST['father_name'])){
                                                                $father=$_POST['father_name'];
                                                            } else{
                                                                $father="";
                                                            }
                                                            $father_name1=!empty(@$user_details->father_name)?@$user_details->father_name:$father; 
                                                        ?>
                                                        <td align="left" style="">
                                                            <input name="father_name" type="text" onkeypress="return onlyAlphabets(event,this);" maxlength="50" title="Please Type Father's Name, Do not entered Mr./Mrs./Km./Dr./Er. etc. in Prefix of your Name " class="CapLetter form-control" style=" width:70%; display: inline" value="<?php echo set_value("father_name", @$father_name1); ?>">
                                                            <span class="form_error"><?php echo form_error('father_name'); ?></span>
                                                        </td>
                                                        <td align="left" style="">
                                                            <span id="">Mother's Name </span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <?php 
                                                            if(isset($_POST['mother_name'])){
                                                                $mother=$_POST['mother_name'];
                                                            } else{
                                                                $mother="";
                                                            }
                                                            $mother_name=!empty(@$user_details->mother_name)?@$user_details->mother_name:$mother; 
                                                        ?>
                                                        <td align="left" style="">
                                                            <input name="mother_name" onkeypress="return onlyAlphabets(event,this);" type="text" maxlength="50" class="CapLetter form-control" style=" width:70%;display: inline" value="<?php echo set_value("mother_name", @$mother_name); ?>">
                                                            <span class="form_error"><?php echo form_error('mother_name'); ?></span>
                                                        </td>
                                                    </tr>

                                                    
                                                    <tr>
                                                        <td align="right" style="">
                                                            <span id="">Identity Proof</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="">
                                                        <?php 
                                                        //print_r($_POST['identity_proof']);
                                                            if(isset($_POST['identity_proof'])){
                                                                $identity_proof1=$_POST['identity_proof'];
                                                            } else{
                                                                $identity_proof1="";
                                                            }
                                                          $identity_proof=!empty(@$user_details->identity_proof)?@$user_details->identity_proof:$identity_proof1; 
                                                        ?>
                                                            <?php $identity_pr = set_value('identity_proof', @$identity_proof); ?>
                                                            <input name="identity_proof" type="radio" value="DL" <?php if ($identity_pr == 'DL') { ?> checked <?php } ?>> DL
                                                            <!-- <input name="identity_proof" type="radio" value="Adhaar" <?php //if ($gender == 'Adhaar') { ?> checked <?php //} ?>> Adhaar -->
                                                            <input name="identity_proof" type="radio" value="Pan" <?php if ($identity_pr == 'Pan') { ?> checked <?php } ?>> Pan
                                                            <input name="identity_proof" type="radio" value="Passport" <?php if ($identity_pr == 'Passport') { ?> checked <?php } ?>> Passport <br>
                                                            <input name="identity_proof" type="radio" value="Voter" <?php if ($identity_pr == 'Voter') { ?> checked <?php } ?>> Voter Id
                                                            <span class="form_error"><?php echo form_error('identity_proof'); ?></span>
                                                        </td>
                                                        
                                                        <td align="left" style="">
                                                            <span id="">Identity Number<br /> (please attach self-attested copy)</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="">
                                                        <?php 
                                                        
                                                            if(isset($_POST['adhar_card_number'])){
                                                                $adhar_card_number1=$_POST['adhar_card_number'];
                                                            } else{
                                                                $adhar_card_number1="";
                                                            }
                                                          $adhar_card_number=!empty(@$user_details->adhar_card_number)?@$user_details->adhar_card_number:$adhar_card_number1; 
                                                        ?>
                                                            <input name="adhar_card_number" id="identity_number" type="text" maxlength="16" title="" class="form-control" 
                                                            style=" width:70%; display: inline" value="<?php echo set_value("adhar_card_number", @$adhar_card_number); ?>">
                                                            <span class="identity_error" style="color:red;"></span>
                                                            <span class="form_error"><?php echo form_error('adhar_card_number'); ?></span>
                                                            <input type="hidden" name="old_adhar_card_doc" value="<?php echo @$user_details->adhar_card_doc; ?>">
                                                          
                                                            <input  style="margin-top: 15px;" type="file" onchange="onlyIdentitypdf(this);" name="adhar_card_doc" id="identity_doc" />
                                                            <span class="form_error"><?php echo form_error('adhar_card_doc'); ?></span>
                                                            <span class="identity_doc_error" style="color:red;"></span>
                                                            <span style="font-size:13px">Please select pdf format file<br>max file size 1MB</span>
                                                        </td>
                                                    
                                                  
                                                    <tr>
                                                        <td align="right" style="">
                                                            <span>Present postal Address </span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <?php 
                                                            if(isset($_POST['corr_address'])){
                                                                $corr_address1=$_POST['corr_address'];
                                                            } else{
                                                                $corr_address1="";
                                                            }
                                                            $corr_address=!empty(@$user_details->corr_address)?@$user_details->corr_address:$corr_address1; 
                                                        ?>
                                                        <td align="left" style="">
                                                            <textarea name="corr_address" id="corr_address" type="text" rows="4" class="CapLetter form-control" style="width: 100%;"><?php echo set_value("corr_address", @$corr_address); ?></textarea>
                                                            <span class="form_error"><?php echo form_error('corr_address'); ?></span>
                                                        </td>

                                                        <td align="left" style="">
                                                            <span>Permanent Address</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <?php 
                                                            if(isset($_POST['perm_address'])){
                                                                $perm_address1=$_POST['perm_address'];
                                                            } else{
                                                                $perm_address1="";
                                                            }
                                                            $perm_address=!empty(@$user_details->perm_address)?@$user_details->perm_address:$perm_address1; 
                                                        ?>
                                                        <td align="left" style="">
                                                            <textarea name="perm_address" id="perm_address" type="text" rows="4" class="CapLetter form-control" style="width: 100%;"><?php echo set_value('perm_address', @$perm_address);
                                                                                                                                                                                    ?></textarea>
                                                            <span class="form_error"><?php echo form_error('perm_address');
                                                                                        ?></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="">
                                                            <span>State</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>

                                                        <td align="left" style="">
                                                        <?php 
                                                            if(isset($_POST['corr_state'])){
                                                                $corr_state1=$_POST['corr_state'];
                                                            } else{
                                                                $corr_state1="";
                                                            }
                                                            $corr_state=!empty(@$user_details->corr_state)?@$user_details->corr_state:$corr_state1; 
                                                        ?>
                                                            <?php $state_id = set_value('corr_state', @$corr_state);
                                                            ?>
                                                            <select name="corr_state" id="corr_state" class="form-control" style="width: 100%;">
                                                                <option value="">--Select--</option>
                                                                <?php

                                                                if (isset($state_list) && !empty($state_list)) {

                                                                    foreach ($state_list as $value) { ?>

                                                                        <option value="<?php echo $value->id; ?>" <?php if ($value->id == $state_id) { ?> selected <?php } ?>><?php echo $value->name; ?></option>
                                                                <?php }
                                                                } ?>
                                                            </select>
                                                            <span class="form_error"><?php echo form_error('corr_state'); ?></span>
                                                        </td>
                                                        <!-- <td align="left" style="width: 70%;">
                                                        <input name="corr_state" id="corr_state" type="text" class="CapLetter form-control" style=" width:30%; display: inline;" value="<?php echo set_value("corr_state", @$user_details->corr_state); ?>">
                                                        <span class="form_error"><?php echo form_error('corr_state'); ?></span>
                                                    </td> -->
                                                    <td align="left" style="">
                                                            <span id="">State</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="">
                                                        <?php 
                                                            if(isset($_POST['perm_state'])){
                                                                $perm_state1=$_POST['perm_state'];
                                                            } else{
                                                                $perm_state1="";
                                                            }
                                                            $perm_state=!empty(@$user_details->perm_state)?@$user_details->perm_state:$perm_state1; 
                                                        ?>
                                                            <?php $state_id = set_value('perm_state', @$perm_state);
                                                            ?>
                                                            <select name="perm_state" id="perm_state" class="form-control" style="width: 100%;">
                                                                <option value="">--Select--</option>
                                                                <?php

                                                                if (isset($state_list) && !empty($state_list)) {

                                                                    foreach ($state_list as $value) { ?>

                                                                        <option value="<?php echo $value->id; ?>" <?php if ($value->id == $state_id) { ?> selected <?php } ?>><?php echo $value->name; ?></option>
                                                                <?php }
                                                                } ?>
                                                            </select>
                                                            <span class="form_error"><?php echo form_error('perm_state'); ?></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="">
                                                            <span>Pincode</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <?php 
                                                            if(isset($_POST['corr_pincode'])){
                                                                $corr_pincode1=$_POST['corr_pincode'];
                                                            } else{
                                                                $corr_pincode1="";
                                                            }
                                                            $corr_pincode=!empty(@$user_details->corr_pincode)?@$user_details->corr_pincode:$corr_pincode1; 
                                                        ?>
                                                        <td align="left" style="">
                                                            <input name="corr_pincode" id="corr_pincode" type="text" maxlength="6" onkeypress="return validateNumber(event)" value="<?php echo set_value('corr_pincode', @$corr_pincode); ?>" class="CapLetter form-control" style=" width:40%; display: inline;"> (6 Digits)
                                                            <span class="form_error"><?php echo form_error('corr_pincode') ?></span>
                                                        </td>

                                                        <td align="left" style="">
                                                            <span id="">Pincode</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <?php 
                                                            if(isset($_POST['perm_pincode'])){
                                                                $perm_pincode1=$_POST['perm_pincode'];
                                                            } else{
                                                                $perm_pincode1="";
                                                            }
                                                            $perm_pincode=!empty(@$user_details->perm_pincode)?@$user_details->perm_pincode:$perm_pincode1; 
                                                        ?>
                                                        <td align="left" style="">
                                                            <input name="perm_pincode" id="perm_pincode" maxlength="6" type="text" onkeypress="return validateNumber(event)" class="CapLetter form-control" style=" width:40%; display: inline;" value="<?php echo set_value('perm_pincode', @$user_details->perm_pincode);
                                                                                                                                                                                                                                                        ?>"> (6 Digits)
                                                            <span class="form_error"><?php echo form_error('perm_pincode');
                                                                                        ?></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="4"><input type="checkBox" onclick="FillAddressInput()" id="checkBox"> Same as Address for present (Click if applicable Permanent address)</td>
                                                    </tr>

                                                   

                                                    <tr>
                                                        
                                                    </tr>


                                                </tbody>
                                            </table>


                                        </td>
                                    </tr>
                                    




                                                </tbody>
                                            </table>


                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <table class="table table-bordered" id="Table1">
                                <tbody>
                                    <tr class="bg-info">
                                        <td colspan="2" style="text-align: center;">
                                            <input type="submit" name="validate" id="validate" value="Save & Next" class="btn btn-success" style="font-weight:bold;width:250px;">
                                            &nbsp;<!--<input type="submit" name="cancle" value="Cancel" id="" class="btn btn-warning" style="width:150px;">
                                        &nbsp;<input type="submit" name="close" value="Close" id="" class="btn btn-danger" style="width:150px;">-->
                                            <a href="<?php echo base_url() . "dashboard/basicInfo"; ?>" class="btn btn-warning" style="width:150px;">Cancel</a>
                                            <a href="<?php echo base_url() . ""; ?>" class="btn btn-danger" style="width:150px;">Close</a>
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

    <script>
        $(document).ready(function() {
            var inputCaptcha = $("#captcha").val();
            var sessCaptcha = '<?php echo $this->session->userdata('captchaCode') ?>';
            $("#details_forms").on('submit', function(e){
                e.preventDefault();
                

                $.ajax({
               
                    url:'<?=base_url()?>dashboard/basic_details_save',
                       type: 'POST', 
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend:function(){
                            $('#contact').attr('disabled', 'disabled');
                        },
                        success:function(data) {
                            if(data.error){
                                if(data.post_id_error != ''){
                                    $('#post_id_error').html(data.post_id_error);
                                } else {
                                    $('#post_id_error').html('');
                                }if(data.email_error != ''){
                                    $('#dob_error').html(data.dob_error);
                                } else {
                                    $('#dob_error').html('');
                                }if(data.subject_error != '') {
                                $('#subject_error').html(data.subject_error);
                                }    else {
                                    $('#subject_error').html('');
                                }if(data.message_error != '') {
                                    $('#message_error').html(data.message_error);
                                }else {
                                    $('#message_error').html('');
                                }
                            }
                            if(data.success){
                                $('#success_message').html(data.success);
                                $('#post_id_error').html('');
                                $('#dob_error').html('');
                                $('#subject_error').html('');
                                $('#message_error').html('');
                                $('#contact_form')[0].reset();
                            }
                            $('#contact').attr('disabled', false);
                        }
                });


            });


            $("#categorys").change();

            if ($("#benchmark_yes").is(":checked") == true) {
                document.getElementById('a2').style.display = "block"
            } else {
                document.getElementById('a2').style.display = "none"
            }
            $(document).on('click', '.benchmark', function() {
                if ($("#benchmark_yes").is(":checked") == true) {
                    document.getElementById('a2').style.display = "block"
                } else {
                    document.getElementById('a2').style.display = "none"
                }
            });

        });

        function categories() {
            var categorys = document.getElementById('categorys').value;
            if (categorys == 1) {
                document.getElementById('a1').style.display = "block"
            } else if (categorys == 2) {
                document.getElementById('a1').style.display = "none"
            }
        }
    </script>
    <script type="text/javascript">
        function FillAddressInput() {
            let checkBox = document.getElementById('checkBox');
            let pAddress = document.getElementById("corr_address");
            let ppincode = document.getElementById("corr_pincode");
            let pState = document.getElementById("corr_state");

            let curAddress = document.getElementById("perm_address");
            let curpincode = document.getElementById("perm_pincode");
            let curState = document.getElementById("perm_state");

            if (checkBox.checked == true) {
                let pAddresses = pAddress.value;
                let ppincoded = ppincode.value;
                let pStates = pState.value;
                curAddress.value = pAddresses;
                curpincode.value = ppincoded;
                curState.value = pStates;
            } else {
                curAddress.value = "";
                curpincode.value = "";
                curState.value = "";

            }
        }
    </script>
    <script language="Javascript" type="text/javascript">
        function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                } else if (e) {
                    var charCode = e.which;
                } else {
                    return true;
                }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 32)
                    return true;
                else
                    return false;
            } catch (err) {
                alert(err.Description);
            }
        }

        function ValidateAlphnumeric(e) {
            const pattern = /^[a-z0-9]+$/i;

            return pattern.test(e.key)
        }
        function ValidateYearPassing(e) {
            alert(e.key);
        }
    </script>


    <script language="Javascript" type="text/javascript">
        function validateNumber(e) {
            $('.obtainmarks').change(function() {
                checkValue();
            });
            // var maxlength = $('degree_diploma[sub][]').length();
            // alert(maxlength);
            // if(maxValue > 0 && $('.obtainmarks').val() > maxValue){
            // $('#obtain').html('obtained marks should not be greater then max marks');
            //     return false
            // }
            $('.maxmarks').change(function() {
                //checkValue();
            });

            const pattern = /^[0-9]$/;

            return pattern.test(e.key)
        }

        function checkValue() {
            var maxValue = $('.maxmarks').val();
            if (maxValue > 0 && $('.obtainmarks').val() > maxValue) {
                $('#obtain').html('obtained marks should not be greater then max marks');
                return false;
            }
        }

        function checkValueN(id) {
            var maxValue = parseInt($('#degree_diploma_uni_add_' + id).val());
            var minValue = parseInt($('#edu_div_add_' + id).val());
            var perc = "";
            if (isNaN(maxValue) || isNaN(minValue)) {
                perc = " ";
            } else {
                perc = ((minValue / maxValue) * 100).toFixed(2);

            }

            $('#edu_div_per_' + id).val(perc);

            if (maxValue > 0 && parseInt($('#edu_div_add_' + id).val()) > maxValue) {
                $('#obtain_add_' + id).html('obtained marks should not be greater then max marks');
                return false;
            } else {
                $('#obtain_add_' + id).html('');
                return false;
            }

        }

        function dateAgo(date) {
            var dobdate = date.split('-');
            var dobmonth = dobdate[1] - 1;

            var currentmonth = new Date().getMonth() + 1;
            //Alok
            var dob = new Date(date);
            var dobYear = dob.getFullYear();
            const today = new Date();

            var calculated_days = 0;
            if (dob.getDate() > 1) {
                var calculated_days = 31 - dob.getDate();
                dobmonth = dobmonth + 1;
            }
            if (dobmonth <= 6) {
                var calculated_month = 6 - dobmonth;
            } else {
                var calculated_month = 18 - dobmonth;
                dobYear = dobYear + 1;
            }

            if (currentmonth <= 7) {
                var yyyy = today.getFullYear();
            } else {
                var yyyy = today.getFullYear();

            }
            var as_on_date = new Date(07 + '-' + 01 + '-' + yyyy);
            var view_on_date = 01 + '-' + 07 + '-' + yyyy;
            var calculated_year = yyyy - dobYear;

            //alert("year "+ calculated_year);
            //alert("month "+ calculated_month);
            var no_of_days = parseInt((as_on_date.getTime() - dob.getTime()) / (1000 * 3600 * 24)) + 1

            //alert("no of days "+ no_of_days);
            var returndata ="";
              if( calculated_days==0 && calculated_month==0){
                returndata = calculated_year + " Years " + calculated_month + " Month and " + calculated_days + " Day";
              }else if(calculated_month>0  &&  calculated_days==0){
                returndata = calculated_year + " Years " + calculated_month + " Months and " + calculated_days + " Day";
              }  else if(calculated_month==0  &&  calculated_days>0){
                returndata = calculated_year + " Years " + calculated_month + " Month and " + calculated_days + " Days";
        
              
              }else{
                 returndata = calculated_year + " Years " + calculated_month + " Months and " + calculated_days + " Days ";
              }
            $('#cand_age').html(returndata);
            $('#dob_calcdate').html(view_on_date);
            $('#candtotal_age').val(no_of_days);
            return;
            //End Alok
            if (currentmonth <= 6) {
                const today = new Date();
                const yyyy = today.getFullYear();
                let mm = today.getMonth() + 1; // Months start at 0!
                let dd = today.getDate();

                if (dd < 10) dd = '0' + dd;
                if (mm < 10) mm = '0' + mm;

                const formattedToday = new Date(07 + '-' + 01 + '-' + yyyy);
                var startDate = new Date(date);
                var diffDate = new Date(formattedToday - startDate);
               // alert(diffDate);
                var returndata = (diffDate.toISOString().slice(0, 4) - 1970) + " Years " +
                    diffDate.getMonth() + " Month ";

                // convert total candidate age in days
                var yearsdays = (diffDate.toISOString().slice(0, 4) - 1970) * 365;
                var monthdays = diffDate.getMonth() * 30.5;
                var totaldays = yearsdays + monthdays + (diffDate.getDate() - 1);
                console.log('totaldays==', totaldays);
                $('#cand_age').html(returndata);
                $('#dob_calcdate').html(formattedToday);
                $('#candtotal_age').val(totaldays);

            } else {
                const today = new Date();
                const yyyy = today.getFullYear();
                let mm = today.getMonth() + 1; // Months start at 0!
                let dd = today.getDate();
                if (dd < 10) dd = '0' + dd;
                if (mm < 10) mm = '0' + mm;

                const formattedToday = new Date(07 + '-' + 01 + '-' + yyyy);
                var startDate = new Date(date);

                var diffDate = new Date(new Date(formattedToday) - startDate);
                var returndata = (diffDate.toISOString().slice(0, 4) - 1970) + " Years " +
                    diffDate.getMonth() + " Month ";
                var yearsdays = (diffDate.toISOString().slice(0, 4) - 1970) * 365;
                var monthdays = diffDate.getMonth() * 30.5;
                var totaldays = yearsdays + monthdays + (diffDate.getDate() - 1);

                console.log('totaldays==', totaldays);
                $('#cand_age').html(returndata);
                $('#dob_calcdate').html(formattedToday);
                $('#candtotal_age').val(totaldays);

            }

        }
        $('#dob').change(function() {
            var dob = $('#dob').val();
            dateAgo(dob);
        })
        
        function isValid_License_Number(license_Number) {

            // Regex to check valid
            // license_Number 
            let regex = new RegExp(/^(([A-Z]{2}[0-9]{2})( )|([A-Z]{2}-[0-9]{2}))((19|20)[0-9][0-9])[0-9]{7}$/);

            // if license_Number
            // is empty return false
            if (license_Number == null) {
                $('.identity_error').html('Please enter license number');
                return false;


            }

            // Return true if the license_Number
            // matched the ReGex
            if (regex.test(license_Number) == true) {
                console.log("true");
                $('.identity_error').html('');
                return true;
            } else {
                console.log("lnum", license_Number);
                $('.identity_error').html('Your license number is invalid');
                return false;


            }
        }

        function ValidateAadhaar(aadhaar) {
            var expr = /^([0-9]{4}[0-9]{4}[0-9]{4}$)|([0-9]{4}\s[0-9]{4}\s[0-9]{4}$)|([0-9]{4}-[0-9]{4}-[0-9]{4}$)/;
            if (!expr.test(aadhaar)) {
                $('.identity_error').html('Aadhar number is invalid');
                return false;
            } else {
                $('.identity_error').html('');
                return true;
            }
        }

        function ValidatePAN(pancard) {

            var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;
            if (regex.test(pancard.toUpperCase())) {
                $('.identity_error').html('');
                return true;
            } else {
                $('.identity_error').html('Pan number is invalid');
                return false;
            }
        }

        function isValidPassportNo(passport) {
            // Regex to check valid
            // Passport Number
            let regex = new RegExp(/^[A-PR-WY][1-9]\d\s?\d{4}[1-9]$/);

            // if str
            // is empty return false
            if (passport == null) {
                $('.identity_error').html('Passport number can not be empty.');
                return false;
            }

            // Return true if the str
            // matched the ReGex
            if (regex.test(passport) == true) {
                $('.identity_error').html('');
                return true;
            } else {
                $('.identity_error').html('Passport number invalid.');
                return false;
            }
        }

        function isValidEPICNumber(votar) {
            // Regex to check valid
            // EPIC Number
            let regex = new RegExp(/^[A-Z]{3}[0-9]{7}$/);

            // if str
            // is empty return false
            if (votar == null) {
                $('.identity_error').html('Voter Id Invalid.');
                return false;
            }

            // Return true if the str
            // matched the ReGex
            if (regex.test(votar) == true) {
                $('.identity_error').html('');
                return true;
            } else {
                $('.identity_error').html('Voter Id Invalid.');
                return false;
            }
        }

        $('input[name="identity_proof"]').click(function() {
            var identity_number = $('#identity_number').val('');
            var identity_proof = $('input[name="identity_proof"]:checked').val();
            if (identity_proof == 'Adhaar') {
                $('#identity_number').attr('maxlength', 12);
            } else {
                $('#identity_number').attr('maxlength', 16);
            }

        });

        $('#identity_doc').click(function() {
            var identity_proof = $('input[name="identity_proof"]:checked').val();
            var identity_number = $('#identity_number').val();
            if (identity_proof == 'DL') {
                console.log("true1");
                isValid_License_Number(identity_number);
            }
            if (identity_proof == 'Adhaar') {

                ValidateAadhaar(identity_number);
            }
            if (identity_proof == 'Pan') {
                ValidatePAN(identity_number);
            }
            if (identity_proof == 'Passport') {
                isValidPassportNo(identity_number);
            }
            if (identity_proof == 'Voter') {
                isValidEPICNumber(identity_number);
            }


        })

      
    </script>
    <script>
        jQuery(document).ready(function($) {
            $('#details_of_exp').keypress(function(e) {
                var regex = new RegExp("^[a-zA-Z0-9\s]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (regex.test(str)) {
                    return true;
                }
                e.preventDefault();
                return false;
            });
        });
    </script>
    <script>
        jQuery(document).ready(function($) {
            $('#particulars_exp').keypress(function(e) {
                var regex = new RegExp("^[a-zA-Z0-9\s]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (regex.test(str)) {
                    return true;
                }
                e.preventDefault();
                return false;
            });
        });
    </script>
    <script>
      
        function getDate(days) {
            let date;

            if (days !== undefined) {
                date = new Date(Date.now() + days * 24 * 60 * 60 * 1000);
            } else {
                date = new Date();
            }

            const offset = date.getTimezoneOffset();

            date = new Date(date.getTime() - (offset * 60 * 1000));

            return date.toISOString().split("T")[0];
        }

        let logMe = document.querySelectorAll('[data-log]');

        for (let item of logMe) {
            item.addEventListener('keyup', function(event) {
                //if (13 == event.which) {
                console.log(this.value);
                //}
            }, false);
        }

        function onlyDobpdf(data) {
            // alert(val);
            // var myFile="";
            var myFile = data.value;8
           

            var upld = myFile.split('.').pop();
            if (upld == 'pdf') {
                $('.dob_doc_error').html('');
                //$("#dob_doc") new FormData($("#multiFiles"));
                // var fd = new FormData($("#dob_doc"));
                // //fd.append('file',myFile);
                
                // var user_id=<?php echo $_SESSION['USER']['user_id']; ?>;
                // var post_id=<?php echo $_COOKIE['post_id']; ?>;
                // var path='dob_proof';
                // fd.append('user_id',user_id);
                // fd.append('post_id',post_id);
                // fd.append('path',path);

                if (Filevalidation(data.id)) {
                    return true
                }
                return false;
            } else {

                $("#dob_doc").val("");
                $('.dob_doc_error').html('Only PDF are allowed.');
                false;
            }
        }

        function onlyCatpdf(data) {
            // alert(val);
            // var myFile="";
            var myFile = data.value;
            var upld = myFile.split('.').pop();
            if (upld == 'pdf') {
                $('.cat_doc_error').html('');
                if (Filevalidation(data.id)) {
                    return true
                }
                return false;
            } else {

                $("#cat_doc").val("");
                $('.cat_doc_error').html('Only PDF are allowed.');
                false;
            }
        }

        function onlyDisablitypdf(data) {
            // alert(val);
            // var myFile="";
            var myFile = data.value;
            var upld = myFile.split('.').pop();
            if (upld == 'pdf') {
                $('.'+data.id+'_error').html('');
                if (Filevalidation(data.id)) {
                    return true
                }
                return false;
            } else {

                $("#person_disability").val("");
                $('.'+data.id+'_error').html('Only PDF are allowed.');
                false;
            }
        }

        function onlyIdentitypdf(data) {

            var myFile = data.value;
            var upld = myFile.split('.').pop();
            if (upld == 'pdf') {
                $('.identity_doc_error').html('');
                if (Filevalidation(data.id)) {
                    return true
                }
                return false;
            } else {
                $("#identity_doc").val("");
                $('.identity_doc_error').html('Only PDF are allowed.');
                false;
            }
        }

        function onlyeducationpdf(data, id) {

            var myFile = data.value;
            var upld = myFile.split('.').pop();
            if (upld == 'pdf') {
                $('.education_doc_' + id+'_error').html('');
                if (Filevalidation(data.id)) {
                    return true
                }
                return false;
            } else {
                $('#education_doc_' + id).val("");
                $('.education_doc_' + id+'_error').html('Only PDF are allowed.');
                false;
            }
        }

        function onlyorganizationpdf(data, id) {

            var myFile = data.value;
            var upld = myFile.split('.').pop();
            if (upld == 'pdf') {
                $('.organization_doc_' + id+'_error').html('');
                if(Filevalidation(data.id)){
                    return true
                }
                return false;
            } else {
                $('#organization_doc_' + id).val("");
                $('.organization_doc_' + id+'_error').html('Only PDF are allowed.');
                false;
            }
        }

  

        Filevalidation = (id) => {
            const fi = document.getElementById(id);

            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {

                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file.
                    if (file >= 1024) {
                        $("#" + id).val("");
                        $('.' + id + '_error').html('File too Big.');
                    
                        return false;
                    }
                    return true;
                }
            }
        }
      

 
    </script>