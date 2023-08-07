<div class="content-wrapper">
    <div class="container-fluid">
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
$this->load->view('common/messages.php');
?>
 
<!-- this is form for add new and edit record  -->
        <div class="row ">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> View Applicant Detals</div>
                    <div class="card-body" style="width: 95%; margin: 27px auto; border: 3px solid #050579;">
                        <div class="photoSig">
                            <h3>Basic Details</h3>
                        <table class="table table-border">
                            <tr>
                                <th>Registration Number </th>
                                <td><?php echo set_value('id', @$basic_info->registration_number);?></td>
							</tr>
							 <tr>
                                <th>Name of the Post Applied for</th>
                                <td><?php echo set_value('post_name', @$post_detail->post_name)?></td>
                            </tr>
                            
                              
                                                   
                                                        <th>Category</th>
                                                        <td><?php $category = set_value('category', @$user_details->category);
														if($category=='1'){
															echo 'Yes';
														}else{
															echo 'No';
														}?>
														<?php if(!empty($user_details->category)&&$user_details->category=='1'){?>
															<a href="<?= base_url('uploads/category_attachment/').@$user_details->category_attachment; ?>" target="_blank" class="btn btn-info">View</a>
														<?php }?></td>
                                                    </tr>
													 <tr>
                                                        <td>Are you a person with benchmark disability of 40% and above?</td>
                                                        <td><?php echo set_value('benchmark', @$user_details->benchmark);?></td>
                                                    </tr>
													<?php if(!empty($user_details->benchmark)&&$user_details->benchmark=='Yes'){?>
                                                    <tr>
                                                        <td>Whether person with disability</td>
                                                        <td><a href="<?= base_url('uploads/person_disability/').@$user_details->person_disability; ?>" target="_blank" class="btn btn-info">View</a></td>
                                                    </tr>
													<?php }?>
                            
                        </table>
                    </div>

                    	<div class="view_table">
                            

                            <div class="row">
                                <div class="col-md-12">
                        <h3>Candidate's Personal Information</h3>
                    	<table class="table table-border">

                    
                    		<tr>
                             <?php    
                            $dobformat = @$user_details->dob;
                            $dob = date("d-m-Y", strtotime($dobformat));
                            ?>
                    			<th >Date Of Birth (DD/MM/YYYY)</th>
                                <td><?php echo set_value('dob', $dob);?><a href="<?= base_url('uploads/dob_proof/').@$user_details->dob_doc; ?>" target="_blank" class="btn btn-info">View</a></td>
                    			<!-- <td><?php //echo set_value('dob', @$basic_info->first_name);?> <?php //echo set_value('middel_name', @$basic_info->middel_name);?> <?php //echo set_value('last_name', @$basic_info->last_name);?></td> -->
                                <th >Age completed as on <?php echo $last_date;?></th>
                                <td><?php echo $dob_age; ?></td>
                               
                    		</tr>
							<tr>
                    		</tr>
                    		<tr>
                    			<th>Gender</th>
                    			<td><?php echo set_value('dob', @$user_details->gender);?></td>
                                <th>Marital State</th>
                                <td><?php echo set_value('marital_status', @$user_details->marital_status);?></td>
                    		</tr>
							<tr>
                    		</tr>
                    		
                    		<tr>
                    			<th>Father's Name</th>
                    			<td><?php echo set_value('father_name', @$user_details->father_name);?></td>
                                <th>Mother's Name</th>
                                <td><?php echo set_value('mother_name', @$user_details->mother_name);?></td>
                    		</tr>
                    		<tr>
                    		</tr>
							<tr>
                    			<th>Identity Proof</th>
                    			<td><?php echo set_value('adhar_card_number', @$user_details->adhar_card_number);?><a href="<?= base_url('uploads/adhar_card_doc/').@$user_details->adhar_card_doc; ?>" target="_blank" class="btn btn-info">View</a></td>
                                <td>Present postal Address</td>
                                <td><?php echo set_value('corr_address', @$user_details->corr_address);?></td>
                    		</tr>
							<tr>
                             </tr>
                             <?php
                                $this->db->where('id', $user_details->corr_state);
                                $q = $this->db->get('tbl_states');
                                $datastate = $q->result_array();
                                ?>
							 <tr>
                                <th>State </th>
                                <td><?php echo set_value('corr_state', $datastate[0]['name']);?></td>
                                <th>PIN Code</th>
                                <td><?php echo set_value('corr_pincode', @$user_details->corr_pincode);?></td>
                             </tr>
                    		<tr>
                    		</tr>
                    		 
                                  <th><b> Contact Details</b></th>
                              
							   <tr>
                                <th>Full Name</th>
                                <td colspan="3"><?php echo set_value('first_name', @$basic_info->first_name);?> <?php echo set_value('middel_name', @$basic_info->middel_name);?> <?php echo set_value('last_name', @$basic_info->last_name);?></td>
								</tr>
							 <tr>
                    			<th>Mobile Number</th>
                    			<td><?php echo set_value('cand_mob', @$basic_info->cand_mob);?></td>
                                <th>Email</th>
                                <td><?php echo set_value('cand_email', @$basic_info->cand_email);?></td>
                    		</tr>
                    		<tr>
                    		</tr>
                    	</table>
                    </div>
                    <div class="col-md-12">
                        <h3>Educational qualifications</h3>
                       
                        <table class="table table-border">
                            <tr>
                                <th>Examination/Degree and Subjects</th>
                                <th>Board/ University</th>
                                <th>Year of Passing</th>
                                <th>Max. Marks</th>
                                <th>Percentage /Marks Obtained</th>
                                <th>Certificate / Mark Sheet</th>
                            </tr>
							<?php 
							$i=0;
							if(!empty($degree_diploma)){
                                // $edudoc = json_decode($user_details->edu_doc);

                                
							foreach($degree_diploma as $value){?>
							<tr>
								<td><?php echo set_value('deg',@$value->deg); ?></td>
								<td><?php echo set_value('year',@$value->year); ?></td>
								<td><?php echo set_value('sub',@$value->sub); ?></td>
								<td><?php echo set_value('uni',@$value->uni); ?></td>
								<td><?php echo set_value('div',@$value->div); ?></td>
                                <td><?php if(!empty($value->file_path)){ ?><a href="<?php echo base_url(); ?>/uploads/education_proof/<?php  echo $value->file_path; ?>" target="_blank" class="btn btn-info">View</a><?php } ?></td>
							</tr>
							<?php $i++; }}  ?>
                            
                        </table>

                       
                    </div>

                    <div class="col-md-12">
                        <?php
                        $orgfile = json_decode($user_details->org_doc);
                        ?>
                    <h3>Experience</h3>
                         <table class="table table-border">
                            <tr>
                                <th>Organization</th>
                                <th>Post held</th>
                                <th>Pay Scale and basic pay</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Appointment Order</th>
                            </tr>
							<?php 
							$i=0;
							$user_work_experience=@$work_experience;
                            if(!empty($user_work_experience[0]->organization)){
							if(isset($user_work_experience)){
                            foreach($user_work_experience as $value){
                                
                                $startdateformat = @$value->from_date;
                                $startdate = date("d-m-Y", strtotime($startdateformat));
    
                                $enddateformat = @$value->to_date;
                                $enddate = date("d-m-Y", strtotime($enddateformat));
                                ?>
                                                    
                           
							<tr>
								<td><?php echo set_value('organization',@$value->organization);?></td>
								<td><?php echo set_value('post_held',@$value->post_held); ?></td>
								<td><?php echo set_value('pay_scale',@$value->pay_scale); ?></td>
								<td><?php if(!empty($startdate)){echo set_value('startdate',$startdate);} ?></td>
								<td><?php if(!empty($enddate)){echo set_value('enddate',$enddate);} ?></td>
                                <td><?php if(!empty($value->file_path)){ ?><a href="<?php echo base_url(); ?>/uploads/organization_file/<?php echo @$value->file_path; ?>" target="_blank" class="btn btn-info">View</a><?php } ?></td>
							</tr>
							<?php $i++; }} } ?>

                        </table> 
						</div>
						 <div class="col-md-12">
                         <table class="table table-border">
                           
                                                        <!-- <tr>
                                                            <th>
                                                            Are you employed, if so, give the name and the address of the Employer	

                                                            </th>
                                                            <td>
                                                               <?php //echo set_value('particulars_exp', @$user_details->particulars_exp);?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>
                                                            Any other relevant information	

                                                            </th>
                                                            <td>
                                                            <?php //echo set_value('details_of_exp', @$user_details->details_of_exp);?>
                                                            </td>
                                                        </tr> -->
                                                        <!-- <tr>
                                                            <th>
                                                            List of enclosures	
	

                                                            </th>
                                                            <td>
                                                           <?php //echo set_value('list_of_enclosures', @$user_details->list_of_enclosures);?>
                                                            </td>
                                                        </tr> -->
                                                        <!-- <tr>
                                                            <th>
                                                            Any other relevant information	

                                                            </th>
                                                            <td>
                                                           <?php //echo set_value('remarks_of_employer', @$user_details->remarks_of_employer);?>
                                                            </td>
                                                        </tr> -->

                        </table>
						
                    </div>

                </div>
                    </div>
                    <?php
                    $csrf = array(
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                    );

                    ?>   
                    <div class="photoSig">
                          <table class="table table-border">
                            <tr>
                                <th width="50%">Photograph</th>
                                <th>Signature</th>
                            </tr>
                            <tr>
                                <td><img width="200" height="150" src="<?php echo site_url('uploads/photograph/'.@$user_details->photograph)?>"  alt=""></td>
                                <td><img width="150" height="70" src="<?php echo site_url('uploads/signature/'.@$user_details->signature);?>" alt=""></td>
                            </tr>

                        </table>
                            </div>
							
                            	
                           <?php $parr= $user_details->application_id."_".$user_details->user_id; ?>
                    <form method="post" action="<?php echo site_url('admin/participants/participantstatus/'.$parr)?>">
                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> 
                    <table class="table table-border">
                        <tr>
                            <th style="vertical-align: middle;">Verify Status </th>
                            <td><select name="status_id" class="form-control error" required="1">
                                  <?php $prestatus_id =   isset($user_details) ? set_value("status_id", @$user_details ->status_id) : set_value("status_id");
                                  
                                  $cos=get_cand_profile_status_list();

                                  foreach($cos as $key_cos =>$value_cos) {
                                    // if($key_cos !=1){
                                      ?>
                                      <option value="<?php  echo $key_cos; ?>"
                                      <?php if($prestatus_id  == $key_cos) { echo 'selected'; }  ?>
                                      ><?php  echo $value_cos; ?></option>
                                      <?php
                                  }
                                //   }
                                  ?>
                              </select>
                                    <span class="form_error"><?php echo form_error('status_id'); ?></span></td>
                                    </tr>
                        <tr>
                            <th style="vertical-align: middle;">Comment</th>
                            <td>
                            <?php $varify_comment =   isset($result) ? set_value("varify_comment", @$result ->varify_comment) : set_value("varify_comment");?>
                              <textarea name="varify_comment" class="form-control" style="width:70%;"><?php echo $varify_comment;?></textarea>
                                                    <span class="form_error"><?php echo form_error('varify_comment'); ?></span></td>
                        </tr>
                               </table>
                       
                        
                                <div class="text-center" style="margin-top: 20px">
                                  <button type="submit" id="srch" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i> Save</button>
                                    <a  href="<?php echo site_url('admin/participants/') ?>" type="reset" id="srch" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
                                   
                                </div>

                   
                    </form>
                      
							
                               <hr/>
                                    <!--div class="text-center">
                                        <a  href="<?php echo site_url('admin/participants/') ?>" type="reset" id="srch" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
                                       
                                    </div-->

                            </div>
                       
                    </div>
                </div>

                </div>
            </div>
        </div><!-- End Row-->


    </div>
    <!-- End container-fluid-->
</div>
