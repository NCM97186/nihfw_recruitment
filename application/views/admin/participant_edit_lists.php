<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('common/messages.php'); 
		$last_date=$post_detail->last_date;
						$dob_age="";
						if(isset($user_details->dob)&&!empty($user_details->dob)){
							$dob_age=cal_diff_in_ymd_format($user_details->dob,$last_date);
						}?>
<!-- this is form for add new and edit record  -->
        <div class="row ">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Edit Applicant Detals</div>
                    <div class="card-body" style="width: 95%; margin: 27px auto; border: 3px solid #050579;">
					
                        <form method="post" enctype="multipart/form-data" action="<?php echo site_url('admin/participants/editlist/'.(isset($user_details->user_id)? @$user_details->user_id :'0')) ?>">

                        <div class="photoSig">
                            <h3>Basic Details</h3>
                        <table class="table table-border">
						
                            <tr>
                                <th>Registration Number </th>
                                <td><input type="text" name="registration_number" value="<?php echo set_value('registration_number', @$post_detail->registration_number)?>"
                                          data-date-inline-picker="true" placeholder="Registration Number" class="form-control error">
                                        <span class="form_error"><?php echo form_error('registration_number'); ?></span></td>
										</tr>
                    		<tr>
                                <th>Name of the Post Applied for</th>
                                <td><?php $post_id= set_value('post_id', @$user_details->post_id);?>
                                                        <select name="post_id" class="form-control" style="width: 40%;">
                                                            <option value="">--Select--</option>
                                                           <?php
														   if(isset($get_job_list)&&!empty($get_job_list)){
                                                        foreach($get_job_list as $value){?>
                                                            <option value="<?php echo $value->post_id;?>" <?php if($value->post_id==$post_id){?> selected <?php }?>><?php echo $value->post_name;?></option>
														   <?php }}?>
                                                        </select>
														<span class="form_error"><?php echo form_error('post_id'); ?></span></td>
                            </tr>
                            <tr>
                                <!--<th>Applied For</th>
                                <td>परीक्षा-2020</td>-->
                                <th>Whether belongs to SC/ST/OBC(as per central government list)/EWS if so, specify the category</th>
                                <td><?php $category= set_value('category', @$user_details->category);?>
                                                        <select name="category" id="categorys" class="form-control" style="width: 40%;"  onchange="categories()">
                                                            <option value="">--Select--</option>
                                                            <option value="1" <?php if($category=='1'){?> selected <?php }?>>Yes</option>
                                                            <option value="2" <?php if($category=='2'){?> selected <?php }?>>No</option>
                                                        </select>
														<span class="form_error"><?php echo form_error('category'); ?></span>
														<br/>
                                                        <table class="" id="a1" name="category_proof" style="display:none;">
                                                         <tr>  
															<td align="right" style="width: 40%;">
                                                       <!-- <input type="radio" name="category_name" value="GENERAL" <?php // echo set_radio('category', 'GENERAL'); 
                                                                                                                    ?>> GENERAL 
                                                        <input type="radio" name="category_name" value="EWS" <?php //echo set_radio('category', 'EWS'); 
                                                                                                        ?>> EWS-->
																										
													<?php $category_name= set_value('category_name', @$user_details->category_name);?>
                                                        <input type="radio" name="category_name" value="OBC" <?php if($category_name=='OBC'){?> checked <?php }?> <?php //echo set_radio('category', 'OBC'); 
                                                                                                        ?>> OBC
                                                        <input type="radio" name="category_name" value="ST" <?php if($category_name=='ST'){?> checked <?php }?> <?php //echo set_radio('category', 'ST'); 
                                                                                                        ?>> ST
                                                        <input type="radio" name="category_name" value="SC" <?php if($category_name=='SC'){?> checked <?php }?> <?php //echo set_radio('category', 'SC'); 
                                                                                                        ?>> SC
                                                        <!--<input type="radio" name="category" value="OH" > OH-->
                                                        <span class="form_error">     <?php echo form_error('category_name');       ?></span>
														 </td></tr>
                                                <tr><td align="right" style="width: 40%;">
														(Self Attested copy of latest certificate to be attached): 
														
                                                            <input type="hidden" name="old_category_attachment" value="<?php echo @$user_details->category_attachment; ?>">
															<input type="file" name="category_attachment"/>
														<span class="form_error"><?php echo form_error('category_attachment'); ?></span>
                                                        </td> </tr>
														</table>

                                                                         
                                                    </td>
                                                </tr>
										 <tr>
												 <th>Are you a person with benchmark disability of 40% and above?.</th>
                                <td><?php $benchmark= set_value('benchmark', @$user_details->benchmark);?>
                                                        <input name="benchmark" id="benchmark_yes" class="benchmark" type="radio" value="Yes"  <?php if($benchmark=='Yes'){?> checked <?php }?>> Yes
                                                        <input name="benchmark" id="benchmark_no" class="benchmark" type="radio" value="No"  <?php if($benchmark=='No'){?> checked <?php }?>> No
                                                        <span class="form_error"><?php echo form_error('benchmark'); ?></span>
														 <table class="" id="a2" name="disability_proof" style="display:none;">
														<tr><td align="right" style="width: 40%;">
															<span id="">Whether person with disability<br />(enclosed self-attested copy of certificate)</span><span style="font-size: medium; color: #CC0000"><?php if(!empty($user_details->person_disability)){?><strong>*</strong><?php }?></span>
</td></tr>
<tr>
														<td align="left" style="width: 60%;">
                                                            <input type="hidden" name="old_person_disability" value="<?php echo @$user_details->person_disability; ?>">
															<input type="file" name="person_disability" class="form-control" style="width: 40%;" />
															<span class="form_error"><?php echo form_error('person_disability'); ?></span>
														</td>
														</tr>
														 </table>
                                                    </td>
													
                                                
										</tr>
                            
                        </table>
                    </div>

                    	<div class="view_table">
                            

                            <div class="row">
                                <div class="col-md-6">
                        <h3>Candidate's Personal Information</h3>
                    	<table class="table table-border">
						<tr>
						   <th>Date Of Birth (DD/MM/YYYY) </th>
                                <td><input type="date" name="dob" class="form-control" value="<?php echo set_value('dob', @$user_details->dob); ?>">
                                        <span class="form_error"><?php echo form_error('dob'); ?></span></td>
										</tr>
										
							<tr>
                    			<th width="300px">Age completed as on <?php echo $last_date;?></th>
                    			<td><?php echo $dob_age; ?></td>
                    		</tr>
										<tr>
                    			<th>Gender</th>
                    			<td><?php $gender= set_value('gender', @$user_details->gender);?>
                                                        <input name="gender" type="radio" value="Male"  <?php if($gender=='Male'){?> checked <?php }?>> Male
                                                        <input name="gender" type="radio" value="Female" <?php if($gender=='Female'){?> checked <?php }?>> Female
                                                        <input name="gender" type="radio" value="Others" <?php if($gender=='Others'){?> checked <?php }?>> Others
                                                        <span class="form_error"><?php echo form_error('gender'); ?></span></td>
                    		</tr>
                    		
							<tr>
                    			<th>Marital State</th>
                    			<td><?php $marital_status= set_value('marital_status', @$user_details->marital_status);?>
                                                        <input name="marital_status" type="radio" value="Unmarrid" <?php if($marital_status=='Unmarrid'){?> checked <?php }?>> Unmarrid
                                                        <input name="marital_status" type="radio" value="Married" <?php if($marital_status=='Married'){?> checked <?php }?>> Married
                                                        <input name="marital_status" type="radio" value="Widow" <?php if($marital_status=='Widow'){?> checked <?php }?>> Widow
                                                        <input name="marital_status" type="radio" value="Widower" <?php if($marital_status=='Widower'){?> checked <?php }?>> Widower
                                                        <input name="marital_status" type="radio" value="Divorced" <?php if($marital_status=='Divorced'){?> checked <?php }?>> Divorced
                                                        <input name="marital_status" type="radio" value="Judicially Separated" <?php if($marital_status=='Judicially Separated'){?> checked <?php }?>> Judicially Separated
                                                        <span class="form_error"><?php echo form_error('marital_status'); ?></span></td>
                    		</tr>
							
                    		
                    		
                    		<tr>
                    			<th>Father's Name</th>
                    			<td><input name="father_name" type="text" maxlength="50" title="Please Type Father's Name, Do not entered Mr./Mrs./Km./Dr./Er. etc. in Prefix of your Name " class="CapLetter form-control" style=" width:70%; display: inline" value="<?php echo set_value("father_name", @$user_details->father_name); ?>">
                                                        <span class="form_error"><?php echo form_error('father_name'); ?></span></td>
                    		</tr>
                    		<tr>
                    			<th>Mother's Name</th>
                    			<td> <input name="mother_name" type="text" maxlength="50" class="CapLetter form-control" style=" width:70%;display: inline" value="<?php echo set_value("mother_name", @$user_details->mother_name); ?>">
                                                        <span class="form_error"><?php echo form_error('mother_name'); ?></span></td>
                    		</tr>
							<tr>
                    			<th>Aadhar Card No</th>
                    			<td>  <input name="adhar_card_number" type="text" maxlength="12" title="" class="form-control" style=" width:70%; display: inline" value="<?php echo set_value("adhar_card_number", @$user_details->adhar_card_number); ?>">
                                                        <span class="form_error"><?php echo form_error('adhar_card_number'); ?></span>
														<input type="hidden" name="old_adhar_card_doc" value="<?php echo @$user_details->adhar_card_doc; ?>">
															<input type="file" name="adhar_card_doc"/>
														<span class="form_error"><?php echo form_error('adhar_card_doc'); ?></span></td>
                    		</tr>
                    		<tr>
                    			<th>Present postal Address</th>
                    			<td><textarea name="corr_address" type="text" rows="4" class="CapLetter form-control" style="width: 70%;"><?php echo set_value("corr_address", @$user_details->corr_address); ?></textarea>
                                                        <span class="form_error"><?php echo form_error('corr_address'); ?></span></td>
                    		</tr>
                                <td>State </td>
                                <td><input name="corr_state" type="text" class="CapLetter form-control" style=" width:30%; display: inline;" value="<?php echo set_value("corr_state", @$user_details->corr_state); ?>">
                                                        <span class="form_error"><?php echo form_error('corr_state'); ?></span></td>
                             </tr>
                    		<tr>
                    			<th>PIN Code</th>
                    			<td><input name="corr_pincode" type="text" value="<?php echo set_value('corr_pincode', @$user_details->corr_pincode); ?>" class="CapLetter form-control" style=" width:30%; display: inline;"> (6 Digits)
                                                        <span class="form_error"><?php echo form_error('corr_pincode') ?></span></td>
                    		</tr>
							 <tr>
                                  <th>Contact Details</th>
                              </tr>
							<tr>
                    			<th width="300px">First Name</th>
                    			<td><input name="first_name" type="text" maxlength="50" title="Please Type First Name" class="CapLetter form-control" style=" width:70%; display: inline" value="<?php echo set_value('first_name', @$basic_info->first_name); ?>"> 
                                                        <span class="form_error"><?php echo form_error('first_name'); ?></span></td>
                    		</tr>
							<tr>
                    			<th width="300px">Middle Name</th>
                    			<td><input name="middel_name" type="text" maxlength="50" title="Please Type Middle Name" class="CapLetter form-control" style=" width:70%; display: inline" value="<?php echo set_value('middel_name', @$basic_info->middel_name); ?>">
                                                        <span class="form_error"><?php echo form_error('middel_name'); ?></span></td>
                    		</tr>
							<tr>
                    			<th width="300px">Last Name</th>
                    			<td> <input name="last_name" type="text" maxlength="50" title="Please Type Last Name " class="CapLetter form-control" style=" width:70%; display: inline" value="<?php echo set_value('last_name', @$basic_info->last_name); ?>">
                                                        <span class="form_error"><?php echo form_error('last_name'); ?></span></td>
                    		</tr>
						<tr>
                    			<th>Mobile Number</th>
                    			<td><input name="cand_mob" type="text" maxlength="50" class="CapLetter form-control" style=" width:70%;display: inline" value="<?php echo set_value("cand_mob", @$user_details->cand_mob); ?>">
                                                        <span class="form_error"><?php echo form_error('cand_mob'); ?></span></td>
                    		</tr>
                    		<tr>
                    			<th>Email</th>
                    			<td><input name="cand_email" type="text" maxlength="50" class="CapLetter form-control" style=" width:70%;display: inline" value="<?php echo set_value("cand_email", @$user_details->cand_email); ?>">
                                                        <span class="form_error"><?php echo form_error('cand_email'); ?></span></td>
                    		</tr>
                    	</table>
                    </div>
                    <div  class="col-md-6">
                        <h3>Details of Educational and other professional / Technical qualifications</h3>
                        <table id="dynamic_field" class="table table-border">
                            <tr>
								<th>Sr.No.</th>
                                <th>Degree/Diploma</th>
                                <th>Year</th>
                                <th>Subjects taken</th>
                                <th>University</th>
                                <th>Division</th>
                            </tr>
							<?php 
                                                       $i=1;
														if(!empty($degree_diploma)){
                                                        foreach($degree_diploma as $value){?>
                                                            <tr id="row<?php echo $i ?>">
                                                                <td align="left" style="" valign="top">
                                                                   <strong><?php echo $i ?>.</strong>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" name="degree_diploma[deg][]" value="<?php echo @$value->deg; ?>" class="form-control">
                                                                    <span class="form_error"><?php //echo form_error('degree_diploma[deg][]'); ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" name="degree_diploma[year][]" value="<?php echo @$value->year; ?>" class="form-control">
                                                                    <span class="form_error"><?php //echo form_error('degree_diploma[year][]'); ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" name="degree_diploma[sub][]" value="<?php echo @$value->sub; ?>" class="form-control">
                                                                    <span class="form_error"><?php //echo form_error('degree_diploma[sub][]'); ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" name="degree_diploma[uni][]" value="<?php echo @$value->uni; ?>" class="form-control">
                                                                    <span class="form_error"><?php //echo form_error('degree_diploma[uni][]'); ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" name="degree_diploma[div][]" value="<?php echo @$value->div; ?>" class="form-control" style="width:80%; float:left">
                                                                    <span class="form_error"><?php //echo form_error('degree_diploma[div][]'); ?></span> 
																<button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn_remove" style="width:16%;  float:right">X</button>
                                                                </td>
                                                            </tr>
														<?php $i++; }}  ?>
													<input type="hidden" id="tq"  value="<?php echo $i ?>" />
                        </table>

                                            <span class="pull-right"><button type="button" name="add" id="add" class="btn btn-success">Add</button></span>
                       
                    </div>

                    <div class="col-md-12">
                    <h3>Details of Employment (Start from present Employer)</h3>
                         <table  id="dynamic_field_work" class="table table-border">
                            <tr>
								<th>Sr.No.</th>
                                <th>Organization</th>
                                <th>Post held</th>
                                <th>Pay Scale and basic pay</th>
                                <th>From</th>
                                <th>To</th>
                            </tr>
							 <?php 
                                                        $i=1;
														$user_work_experience=$work_experience;
														if(isset($user_work_experience)){
                                                        foreach($user_work_experience as $value){?>
                                                            <tr id="rowwork<?php echo $i ?>">
                                                                <td align="left" style="" valign="top">
                                                                    <strong><?php echo $i ?>.</strong>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" name="work_experience[organization][]" value="<?php echo @$value->organization; ?>" class="form-control">
                                                                    <span class="form_error"><?php //echo form_error('organization[]'); ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" name="work_experience[post_held][]" value="<?php echo @$value->post_held; ?>" class="form-control">
                                                                    <span class="form_error"><?php //echo form_error('post_held[]'); ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" name="work_experience[pay_scale][]" value="<?php echo @$value->pay_scale; ?>" class="form-control">
                                                                    <span class="form_error"><?php //echo form_error('work_experience[pay_scale][]'); ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="date" name="work_experience[from_date][]" value="<?php if(!empty($value->from_date)){echo date_convert_normal_to_mysql($value->from_date);} ?>" class="form-control">
                                                                    <span class="form_error"><?php //echo form_error('work_experience[from_date][]'); ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
														<input type="date" name="work_experience[to_date][]" value="<?php if(!empty($value->to_date)){echo date_convert_normal_to_mysql($value->to_date);} ?>" class="form-control" style="width:80%; float:left">
                                                                    <span class="form_error"><?php //echo form_error('work_experience[to_date][]'); ?></span><button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn_remove_work" style="width:16%;  float:right">X</button>
                                                                </td>
                                                            </tr>
														<?php $i++; }}  ?>
														<input type="hidden" id="tq_work"  value="<?php echo $i ?>" />
                        </table>
                                            <span class="pull-right"><button type="button" name="add" id="addwork" class="btn btn-success">Add</button></span>
                    </div>
					
                </div>
                    </div>
                       
                            <div class="photoSig">
                          <table class="table table-border">
						  <tr>
                                <th>Are you employed, if so, give the name and the address of the Employer</th>
                                <td><textarea name="particulars_exp" type="text" rows="3" class="form-control" style="width:70%;"><?php echo set_value("particulars_exp", @$user_details->particulars_exp);?></textarea></td>
										</tr>
										<tr>
                                <th>Any other relevant information</th>
                                <td> <textarea name="details_of_exp" type="text" rows="3" class="form-control" style="width:70%;"><?php echo set_value("details_of_exp", @$user_details->details_of_exp);?></textarea></td>
										</tr>
										<tr>
                                <th>List of enclosures</th>
                                <td><textarea name="list_of_enclosures" type="text" rows="3" class="form-control" style="width:70%;"><?php echo set_value("list_of_enclosures", @$user_details->list_of_enclosures);?></textarea></td>
										</tr>
										<tr>
                                <th> Remarks of the employer if application is forwarded through proper channel</th>
                                <td> <textarea name="remarks_of_employer" type="text" rows="3" class="form-control" style="width:70%;"><?php echo set_value("remarks_of_employer", @$user_details->remarks_of_employer);?></textarea></td>
										</tr>
										<tr>
                            <tr>
                                <th width="50%">Photograph</th>
                                <th>Signature</th>
                            </tr>
                            <tr>
                                <td> <input name="photograph" type="file" title="Please upload your Signature" class="CapLetter form-control" value="<?php echo set_value("photograph"); ?>" accept="image/jpeg,image/gif,image/png,image/jpg">

                                                        <em>
                                                            <span class="form_error"><?php echo form_error('photograph'); ?></span>
                                                        </em>
														<?php if (isset($user_details->photograph)) { ?>
														 <input type="hidden" name="old_photo" value="<?php echo @$user_details->photograph; ?>">
														<img width="200" height="150" src="<?php echo site_url('uploads/photograph/'.@$user_details->photograph)?>"  alt="">
														<?php }?></td>
                                <td> <input name="signature" type="file" title="Please upload your Signature" class="CapLetter form-control" value="<?php echo set_value("signature", @$user_details->signature); ?>" accept="image/jpeg,image/gif,image/png,image/jpg">
														 <span class="form_error"><?php echo form_error('signature'); ?></span>
                                                         <?php if (isset($user_details->signature)) { ?>
                                                             <input type="hidden" name="old_sign" value="<?php echo @$user_details->signature; ?>"><img width="150" height="70" src="<?php echo site_url('uploads/signature/'.@$user_details->signature);?>" alt="">
														 <?php }?></td>
                            </tr>

                                   </table>
                            </div>
							
								
                           
                            
							
                               <hr/>
                                    <div class="text-center">
									  <button type="submit" id="srch" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i> Save</button>
                                        <a  href="<?php echo site_url('admin/participants/') ?>" type="reset" id="srch" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
                                       
                                    </div>

                            </div>
                       
                        </form>
                    </div>
                </div>

                </div>
            </div>
        </div><!-- End Row-->


    </div>
    <!-- End container-fluid-->
</div>
<script>
 $(document).ready(function() {
		if($('#tq').val()!=''){
			var i = $('#tq').val();
		}else{
			var i = 1;
		}

        $('#add').click(function() {
            b = i++;
            $('#dynamic_field').append('<tr id="row' + b + '"><td><strong>' + b + '.</strong></td><td><input type="text" name="degree_diploma[deg][]"  class="form-control" /></td><td><input type="text" name="degree_diploma[year][]" class="form-control" /></td><td><input type="text" name="degree_diploma[sub][]" class="form-control" /></td><td><input type="text" name="degree_diploma[uni][]" class="form-control" /></td><td><input type="text" name="degree_diploma[div][]" class="form-control" style="width:80%; float:left"/> <button type="button" name="remove" id="' + b + '" class="btn btn-danger btn_remove" style="width:16%;  float:right">X</button></td></tr>');
            $('#tq').val(b);
        });
		if($('#tq_work').val()!=''){
			var j = $('#tq_work').val();
		}else{
			var j = 1;
		}

        $('#addwork').click(function() {
            b = j++;
            $('#dynamic_field_work').append('<tr id="rowwork' + b + '"><td><strong>' + b + '.</strong></td><td><input type="text" name="work_experience[organization][]"  class="form-control" /></td><td><input type="text" name="work_experience[post_held][]" class="form-control" /></td><td><input type="text" name="work_experience[pay_scale][]" class="form-control" /></td><td><input type="date" name="work_experience[from_date][]" class="form-control" /></td><td><input type="date" name="work_experience[to_date][]" class="form-control" style="width:80%; float:left"/> <button type="button" name="remove" id="' + b + '" class="btn btn-danger btn_remove_work" style="width:16%;  float:right">X</button></td></tr>');
            $('#tq_work').val(b);
        }); 
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
		 $(document).on('click', '.btn_remove_work', function() {
            var button_id = $(this).attr("id");
            $('#rowwork' + button_id + '').remove();
        });
		$("#categorys").change();
		
			if($("#benchmark_yes").is(":checked")==true){
				document.getElementById('a2').style.display = "block"
			}else{
				document.getElementById('a2').style.display = "none"
			}
		$(document).on('click', '.benchmark', function() {
			if($("#benchmark_yes").is(":checked")==true){
				document.getElementById('a2').style.display = "block"
			}else{
				document.getElementById('a2').style.display = "none"
			}
        });
   
   });
   
		function categories() {
			var categorys=document.getElementById('categorys').value;
			if (categorys == 1) {
              document.getElementById('a1').style.display = "block"
             } else if (categorys == 2) {
               document.getElementById('a1').style.display = "none"
            }
       }
		</script>