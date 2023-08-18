<?php

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html, body{
            height: 100%;
            font-family: 'Open Sans', sans-serif;
            font-size: 100%;
            line-height: 24px;
            font-weight: 400;
            vertical-align: baseline;
            background: #ffffff;
            color: #707070;
            margin: 0;
        }
        .row{
            display: flex;
            /* display: inline; */
        }
       

        /* .national_form_border {
    border: 1px solid #4cae4c;
    box-shadow: 0px 0px 10px 3px #4cae4c;
} */
#national_form {
    text-align: center;
    margin: 4% 0px;
}
th{
    background-color: #adadad;
}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse;
}
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
    border: 1px solid #ddd;
}
/* .table-bordered>tbody>tr>td {
    background: rgba(71, 91, 168, 0.08);
} */
.table .table {
    background-color: #fff;
}
.table-bordered {
    border: 2px solid #c7c2c2;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 5px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}

/* .bg-info {
    color: #fff;
    background-color: #ffb000;
    border-color: #4558a9;
    font-weight: bolder;
}

.bg-danger {
    color: #fff;
    background-color: #aa5cb8;
    border-color: #d43f3a;
} */

/* @media (min-width: 1200px){
.container {
    width: 1170px;
}} */

@media (min-width: 992px){
.container {
    width: 970px;
}}
@media (min-width: 768px){
.container {
    width: 750px;
}}
.container {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

@media (min-width: 1200px){
.container {
    padding-right: 15px;
    margin-bottom: 60px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    width: 1170px;
}}
    </style>
</head>
<body>
  


<header>
        <div style="margin-top:30px">

            <img src="<?= base_url('assets/img/logo-nihfw-1.jpg'); ?>" alt="logo" style="margin-right:0px; margin-left:170px; max-width:250px" > 
            <img src="<?= base_url('assets/img/logo-new-1.jpg'); ?>" alt="logo" style="margin:0 70px; max-width:400px"> 
            <img src="<?= base_url('assets/img/ministry_logo.png'); ?>" alt="logo" style="max-width:200px" > 
        </div>
    </header>

    <div style="padding-left: 100px;">
        <div id="national_form" class="" style="text-align: center; width: 90%;">

            <div class="panel panel-info national_form_border">

                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: #fff; width: 100%">

                        <form method="post" id="notification-form">    
                        <table class="" style="width: 100%;" id="tbl_Candidate">
                                <tbody>
                                    <!-- <tr> -->
                                        <td colspan="2" style="text-align: left; width: 100%;">
                                            <table  class="table table-bordered" style="width: 100%; border: 2px solid #c7c2c2;" id="tblcndt">
                                                <tbody>
                                                    <tr style="color: #000;">
                                                        <th >Application ID</th>
                                                        <th colspan="4"><?php echo $user_details->application_id; ?></th>
                                                    </tr>
                                                    <tr>
                                                        <td ><b>Post</b></td>
                                                        <td colspan="3"><?php echo $user_details->post_name; ?></td>
                                                        <td rowspan="5"><img src="<?= base_url('uploads/photograph/'.$user_details->photograph); ?>" alt="user" class="img-responsive" style="width:125px; margin: 0 auto; aspect-ratio:3/3.5; object-fit:cover;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td ><b>First Name</b></td>
                                                        <td ><?php echo $user_details->first_name; ?></td>
                                                        <td ><b>Middle Name</b></td>
                                                        <td ><?php echo $user_details->middel_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 20%;"><b>Last Name</b></td>
                                                        <td><?php echo $user_details->last_name; ?></td>
                                                        <td style="width: 20%;"><b>PWBD</b></td>
                                                        <td><?php echo $user_details->benchmark; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td ><b>Mobile</b></td>
                                                        <td ><?php echo $user_details->cand_mob; ?></td>
                                                        <td ><b>Email</b></td>
                                                        <td ><?php echo $user_details->cand_email; ?></td>
                                                       
                                                    </tr> 
                                                    <!-- <tr>
                                                        <td style="width: 20%;"><b>Email</b></td>
                                                        <td ><?php echo $user_details->cand_email; ?></td>
                                                        
                                                    </tr> -->
                                                    <tr>
                                                        <td style="width: 10%;"><b>Category</b></td>
                                                        <td colspan=""><?php echo $category_name; ?></td>
                                                        <td style="width: 10%;"><b>Department</b></td>
                                                        <td colspan=""><?php if($user_details->department == '2') { 
                                                            echo "NO"; 
                                                        }else{
                                                               echo "YES"; 
                                                            }?></td>
                                                        

                                                       
                                                    </tr>
                                                    
                                                                                               

                                                </tbody>
                                            </table>


                                        </td>
                                    </tr>

                                    

                                    <tr>
                                        <td colspan="2"  style="text-align: left; width: 100%;">
                                            <table  class="table table-bordered" style="width: 100%; border: 2px solid #c7c2c2;" id="tblcndt">
                                                <tbody>
                                                <tr class="bg-info">
                                        <th colspan="6" class="heading2" style="text-align: left; width: 100%;">
                                            <span style="color: #000;">Personal Details ↓ </span>
                                        </th>
                                    </tr>
                                                    <tr>
                                                        
                                                        <td  style="width: 25%;"><b>Date Of Birth</b></td>
                                                        <?php $dbdateofbirth = $user_details->dob;
		                                                           $dob = date("d-m-Y", strtotime($dbdateofbirth));
                                                                   ?>
                                                        <td colspan="" style="width: 25%;"><?php echo $dob; ?></td>
                                                        <td  style="width: 25%;"><b>Age</b></td>
                                                        <td colspan="3" style="width: 25%;"><?php  echo $dob_age; ?></td>
                                                      
                                                        
                                                    </tr>
                                                   
                                                    <tr>
                                                        <td  style="width: 25%;"><b>Gender</b></td>
                                                        <td colspan="" style="width: 25%;"><?php echo $user_details->gender; ?></td>
                                                        <td  style="width: 25%;"><b>Marital Status</b></td>
                                                        <td colspan="3" style="width: 25%;"><?php echo $user_details->marital_status; ?></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td  style="width: 25%;"><b>Father's Name</b></td>
                                                        <td colspan="" style="width: 25%;"><?php echo $user_details->father_name; ?></td>
                                                        <td  style="width: 25%;"><b>Mother's Name</b></td>
                                                        <td colspan="3" style="width: 25%;"><?php echo $user_details->mother_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td  style="width: 25%;"><b>Present postal Address</b></td>
                                                        <td  style="width: 25%;"><?php echo $user_details->corr_address; ?></td>
                                                        <?php $res= $this->db->select('name')->from('tbl_states')->where('id',$user_details->corr_state)->get()->row(); ?> 
                                                        <td  style="width: 25%;"><b>State</b></td>
                                                        <td  style="width: 25%;"><?php echo $res->name; ?></td>
                                                        <td  style="width: 15%;"><b>Pincode</b></td>
                                                        <td  style="width: 15%;"><?php echo $user_details->corr_pincode; ?></td>
                                                        
                                                    </tr>    
                                                    <tr>
                                                        <td  style="width: 25%;"><b>Permanent Address</b></td>
                                                        <td  style="width: 25%;"><?php echo $user_details->perm_address; ?></td>
                                                        <?php $state = $this->db->select('name')->from('tbl_states')->where('id',$user_details->perm_state)->get()->row(); ?> 
                                                        <td  style="width: 25%;"><b>State</b></td>
                                                        <td  style="width: 25%;"><?php echo $state->name; ?></td>
                                                        <td  style="width: 15%;"><b>Pincode</b></td>
                                                        <td  style="width: 15%;"><?php echo $user_details->perm_pincode; ?></td>
                                                       
                                                    </tr>
                                                    <tr>
                                                        
                                                        <td  style="width: 25%;"><b>Identity Proof</b></td>
                                                        <td colspan="" style="width: 25%;"><?php echo $user_details->identity_proof; ?></td>
                                                        <td  style="width: 25%;"><b>Identity Number</b></td>
                                                        <td colspan="3" style="width: 25%;"><?php echo $user_details->adhar_card_number; ?></td>
                                                    </tr>
                                                 

                                                 
                                                </tbody>
                                            </table>


                                        </td>
                                    </tr>

                                   

                                    <tr style="font-size: 12pt">
                                        <td colspan="2" style="text-align: left">
                                            <div style="text-align: left">
                                                <table id="dynamic_field" class="table table-bordered" style="width: 100%; border: 2px solid #c7c2c2;">
                                                    <tbody>
                                                    <tr class="bg-info">
                                        <th colspan="6" class="heading2" style="text-align: left; width: 100%;">
                                            <span style="color: #000;">Details of Educational and other professional / Technical qualifications ↓ </span>
                                            <input type="hidden" name="trow" id="tq" value="5">
                                        </th>
                                    </tr>
                                                    <tr class="bg-danger">
                                                            <td  style="font-weight: bold; color: #000;" valign="top">Degree/Diploma</td>
                                                            <td  style="font-weight: bold; color: #000;" valign="top">Board/University</td>
                                                            <td  style="font-weight: bold; color: #000;" valign="top">Year</td>
                                                            <td  style="font-weight: bold; color: #000;" valign="top">Max Marks</td>
                                                            <td  style="font-weight: bold; color: #000;" valign="top">Obtained Marks</td>
                                                            <td  style="font-weight: bold; color: #000;" valign="top">Percentage</td>
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
                                                            <td align="left"><?php echo set_value('deg',@$value->deg); ?></td>
                                                            <td align="left"><?php echo set_value('year',@$value->year); ?></td>
                                                            <td align="left"><?php echo set_value('sub',@$value->sub); ?></td>
                                                            <td align="left"><?php echo set_value('uni',@$value->uni); ?></td>
                                                            <td align="left"><?php echo set_value('div',@$value->div); ?></td>
                                                            <td align="left"><?php echo set_value('div',@$value->per); ?></td>
                                                        </tr>
                                                        
														<?php
                                                        $k++;
                                                        $i++; }}  ?>
                                                   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    

                                    <tr style="font-size: 12pt">
                                        <td colspan="2" style="text-align: left">
                                            <div style="text-align: left">
                                                <table id="dynamic_field" class="table table-bordered" style="width: 100%; border: 2px solid #c7c2c2;">
                                                    <tbody>
                                                    <tr class="bg-info">
                                        <th colspan="5" class="heading2" style="text-align: left; width: 100%;">
                                            <span style="color: #000;">Work Experience details (Start from present Employer) ↓ </span>
                                        </th>
                                    </tr>
                                                    <tr class="bg-danger">
                                                            <td  style="font-weight: bold; color: #000;" valign="top">Organization</td>
                                                            <td  style="font-weight: bold; color: #000;" valign="top">Post Held</td>
                                                            <td  style="font-weight: bold; color: #000;" valign="top">Pay Scale and Basic Pay</td>
                                                            <td  style="font-weight: bold; color: #000;" valign="top">From</td>
                                                            <td  style="font-weight: bold; color: #000;" valign="top">To</td>
                                                            <!-- <td  style="font-weight: bold; color: #000;" valign="top">Organization certificates</td> -->
                                                        </tr><?php 
                                                        $i=1;
                                                        $k = 0;
														$user_work_experience=@$work_experience;
                                                        
                                                       if(!empty($user_work_experience[0]->organization)){
														if(isset($user_work_experience)){
                                                        foreach($user_work_experience as $value){?>
                                                        <tr>
                                                            <td align="left"><?php echo set_value('organization',@$value->organization);?></td>
                                                            <td align="left"><?php echo set_value('post_held',@$value->post_held); ?></td>
                                                            <td align="left"><?php echo set_value('pay_scale',@$value->pay_scale); ?></td>
														<td align="left"><?php  if(!empty($value->from_date)){echo set_value('from_date',date_convert_normal_to_mysql($value->from_date));} ?></td>
                                                            <td align="left"><?php if(!empty($value->to_date)){echo set_value('to_date',date_convert_normal_to_mysql($value->to_date));} ?></td>                                                        </tr>
														<?php
                                                        $k++;
                                                        $i++; }} } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    
                                    
                                    
                                </tbody>
                            </table>
                            <table class="table table-bordered" style="width: 100%; border: 2px solid #c7c2c2;">
                            <tr style="width: 100%; border: 2px solid #c7c2c2;">
                                <td  ><b>Fee</b></td>
                                <td align="left" ><?php
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
                            </table>
                            <table class="table-bordered" style="border: 2px solid #c7c2c2;border-collapse: collapse;">
                                    <tr class="bg-info" >
                                        <th colspan="2" class="heading2" style="text-align: left; width: 100%;">
                                            <span style="color: #000; padding:5px;">Declaration</span>
                                        </th>
                                    </tr>
                                    <tr >
                                    <td colspan="2"><p style="padding:5px; margin:0; ">I hereby declare that I am a citizen of India. The entries in this application form are complete, true and correct to the best of my knowledge and belief. I have read carefully all the examination rules and provisions related to this advertisement and I promise to follow these and also promise that I will not use any unfair means during examination. <br>
                                    I fulfil all the eligibility criteria i.e. age limit, educational qualification today as prescribed in the advertisement. I have all the eligibility certificates, whenever the NIHFW will ask for it I will produce the same failing which my candidature can be cancelled by the NIHFW at any time. In case of any information provided by me found to be false or Incorrect before or after the examination, the NIHFW can cancel my candidature. I declare that I have filled only one application form for this examination.</p></td>
                                    </tr>
                                    <tr>
                                        <td><b style="padding-left:5px;">Date:</b> <?php echo date('d-m-Y')?></td>                                    
                                        <td ><img src="<?= base_url('uploads/signature/').@$user_details->signature; ?>" alt="user" class="img-responsive" style="width:100px; margin: 0 auto;"></td>
                                                        <!-- <th ><img src="blank.jpg" alt="user" class="img-responsive" style="width:150px; margin: 0 auto;"></th> -->
                                    </tr>
                                    </table>
                        </form>

                    </div>
                </div>

            </div>
        </div>
        <!-- Main body End Here -->
    </div>













</body>
</html>