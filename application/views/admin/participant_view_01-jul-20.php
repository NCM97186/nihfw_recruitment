<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('common/messages.php'); ?>
<!-- this is form for add new and edit record  -->
        <div class="row ">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> <?php echo (isset($ddata)?'Edit':'Add'); ?> Applicant Detals</div>
                    <div class="card-body" style="width: 95%; margin: 27px auto; border: 3px solid #050579;">
                        <div class="photoSig">
                            <h3>Notification Details</h3>
                        <table class="table table-border">
                            <tr>
                                <th>Advertisement Number </th>
                                <td>Advt2020-03</td>
                                <th>Examination Name</th>
                                <td>Sr. Consultent</td>
                            </tr>
                            <tr>
                                <th>Applied For</th>
                                <td>परीक्षा-2020</td>
                                <th>Date for Calculating Age</th>
                                <td>01/07/2020</td>
                            </tr>
                            
                        </table>
                    </div>

                    	<div class="view_table">
                            

                            <div class="row">
                                <div class="col-md-6">
                        <h3>Candidate's Personal Information</h3>
                    	<table class="table table-border">
                    		<tr>
                    			<th width="300px">Name</th>
                    			<td><?php echo $results->cand_name?></td>
                    		</tr>
                    		<tr>
                    			<th>Address</th>
                    			<td><?php echo $results->cand_addr_corr?></td>
                    		</tr>
                    		<tr>
                    			<th>Office where working at present</th>
                    			<td><?php echo $results->cand_addr?></td>
                    		</tr>
                    		<tr>
                    			<th>Mobile Number</th>
                    			<td><?php echo $results->cand_mob?></td>
                    		</tr>
                    		<tr>
                    			<th>Email</th>
                    			<td><?php echo $results->cand_email?></td>
                    		</tr>
                    		<tr>
                    			<th>Landline</th>
                    			<td><?php echo $results->cand_landline?></td>
                    		</tr>
                    		<tr>
                    			<th>Address for correspondence</th>
                    			<td><?php echo $results->cand_addr_corr?></td>
                    		</tr>
                    		<tr>
                    			<th>PIN Code</th>
                    			<td><?php echo $results->cand_pincode?></td>
                    		</tr>
                    		<tr>
                    			<th>Date Of Birth</th>
                    			<td><?php echo $results->cand_dob?></td>
                    		</tr>
                    	</table>
                    </div>
                    <div class="col-md-6">
                        <h3>Educational qualifications</h3>
                        <table class="table table-border">
                            <tr>
                                <th>Degree/Diploma</th>
                                <th>Year</th>
                                <th>Subjects taken</th>
                                <th>University</th>
                                <th>Division</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            
                        </table>

                       
                    </div>

                    <div class="col-md-12">
                    <h3>Experience</h3>
                        <table class="table table-border">
                            <tr>
                                <th>Brief Service particulars / Experience / Organization (Please enclosed a sheet if necessary)</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Details of experience of working in Health sector & E-health background</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Whether SC/ST/OBC/Gen</th>
                                <td></td>
                            </tr>
                        </table>
                    </div>

                </div>
                    </div>
                       
                            <div class="photoSig">
                          <table class="table table-border">
                            <tr>
                                <th width="50%">Photograph</th>
                                <th>Signature</th>
                            </tr>
                            <tr>
                                <td><img width="200" height="150" src="<?php echo site_url('uploads/'.$results->image)?>"  alt=""></td>
                                <td><img width="150" height="70" src="<?php echo site_url('uploads/sign/'.$results->signature)?>" alt=""></td>
                            </tr>

                                   </table>
                            </div>
							
								
                           
                            
							
                               <hr/>
                                    <div class="text-center">
                                        <a  href="<?php echo site_url('admin/participants/') ?>" type="reset" id="srch" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
                                       
                                    </div>

                            </div>
                       
                    </div>
                </div>

                </div>
            </div>
        </div><!-- End Row-->


    </div>
    <!-- End container-fluid-->
</div>
