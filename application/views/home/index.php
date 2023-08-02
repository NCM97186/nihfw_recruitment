<div class="contact-page-area padding-bottom">
    <div class="container">
        <div id="national_form" class="container" style="text-align: center">
            <div class="panel panel-info national_form_border">
			<?php if(!empty($result)){?>
                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%">
					
                      <form method="post" id="notification-form" action="<?php echo site_url('home/save') ?>" enctype="multipart/form-data">
                        <table class="table table-bordered" id="tbl_Candidate">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-left"></td>
                                </tr>
                                <tr class="bg-info">
                                    <td colspan="2" class="heading2">
                                        <span>Notification Details: <span id=""></span> ↓ </span>
                                    </td>
                                </tr>

                                <tr style="font-size: 12pt">
                                    <td colspan="2" style="width: 100%; text-align: center;">
                                        <table border="0" class="table table-bordered" style="width: 100%" cellpadding="0" cellspacing="0" id="tbl_Header">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 20%; text-align: left; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                        <span id="" style="color:#4658a9; font-weight:bold;">Advertisement Number : </span>
                                                    </td>
                                                    <td style="text-align: left; width: 30%; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                        <span style="color:Maroon;"><?php if(isset($result[0])){ echo $result[0]->adver_no; }else{ echo set_value('adver_no');}?></span>
                                                        <input type="hidden" id="" name="adver_no" value="<?php echo isset($result) ? set_value("adver_no", $result[0]->adver_no) : set_value("adver_no"); ?>">
                                                    </td>

                                                    <td style="text-align: left; width: 20%; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                        <span id="" style="color:#4658a9;font-weight:bold;">Examination Name : </span>
                                                    </td>
                                                    <td style="text-align: left; width: 30%; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                        <span style="color:Maroon;"><?php if(isset($result[0])) {echo $result[0]->post_name; } else{ echo set_value('post_name');}?></span>
                                                        <input type="hidden" id="" name="post_name" value="<?php echo isset($result) ? set_value("post_name", $result[0]->post_name) : set_value("post_name");  ?>">
                                                        <input type="hidden" id="" name="post_id" value="<?php echo isset($result) ? set_value("post_id", $result[0]->post_id) : set_value("post_id");  ?>">

                                                        <input type="hidden" id="minAgeDate" name="minAgeDate" value="<?php echo isset($result) ? set_value("min_age_date", $result[0]->min_age_date) : set_value("min_age_date");  ?>">
                                                        <input type="hidden" id="maxAgeDate" name="maxAgeDate" value="<?php echo isset($result) ? set_value("max_age_date", $result[0]->max_age_date) : set_value("max_age_date");  ?>">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    
                                                    <td style="text-align: left; width: 30%; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                        <span id="" style="color:#4658a9;font-weight:bold;">Date for Calculating Age :</span>
                                                    </td>
                                                    <td style="text-align: left; width: 30%; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                      
                                                        <span id="" style="color:Maroon;font-weight:normal;"><?php if(isset($result[0])) {echo $result[0]->max_age_date; } else{ echo set_value('max_age_date');}?></span>
                                                    </td>
													<td style="text-align: left; width: 20%; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                        <!--<span id="" style="color:#4658a9;font-weight:bold;">Applied For : </span>-->
                                                    </td>
                                                    <td style="text-align: left; width: 30%; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                        <!--<span id="" style="color:Maroon;">परीक्षा-2020,</span>-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>


                                <tr class="bg-info">
                                    <td colspan="2" class="heading2">
                                        <span>Candidate's Personal Information ↓ </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="text-align: left; width: 100%;">
                      <table align="left" class="table table-bordered" style="width: 100%" id="tblcndt">
                          <tbody>
                            <tr>
                                <td align="right" style="width: 30%;">

                                    <span id="">Upload Photograph </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                </td>
                                <td align="left" style="width: 70%;">
                                    <input name="image" type="file" maxlength="50" id="" title="Please upload your current Photograph" class="CapLetter form-control" style=" width:70%;" value="<?php echo set_value('image'); ?>" accept="image/x-png,image/gif,image/jpeg">
                                    <br />
                                    <em>
                                        <span class="form_error"><?php echo form_error('image'); ?></span>
                                      </em>
                                </td>

                            </tr>
                            <tr>
                                <td align="right" style="width: 30%;">

                                    <span id="">Upload Signature </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                </td>
                                <td align="left" style="width: 70%;">
                                    <input name="signature" type="file" maxlength="50" id="" title="Please upload your Signature" class="CapLetter form-control" style=" width:70%;" value="<?php echo set_value('signature'); ?>" accept="image/x-png,image/gif,image/jpeg">
                                    <br />
                                    <em>
                                        <span class="form_error"><?php echo form_error('signature'); ?></span>
                                      </em>
                                </td>

                            </tr>
                              <tr>
                                  <td align="right" style="width: 30%;">

                                      <span id="">Name of the applicant </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                  </td>
                                  <td align="left" style="width: 70%;">
                                      <input name="cand_name" type="text" maxlength="50" id="" title="Please Type Candidate Name, Do not entered Mr./Mrs./Km./Dr./Er. etc. in Prefix of your Name " class="CapLetter form-control" style=" width:70%;" value="<?php echo set_value('cand_name'); ?>">
                                      <br />
                                      <em><span style="color: #7d7e7f">( Do not enter Mr./Mrs./Km./Dr./Er. etc. in Prefix of your Name )</span>
                                        <span class="form_error"><?php echo form_error('cand_name'); ?></span>
                                      </em>
                                  </td>
                              </tr>

                              <tr>
                                  <td align="right" style="width: 30%;">
                                      <span id="">Address </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>

                                  </td>
                                  <td align="left" style="width: 70%;">
                                      <textarea name="cand_addr"  rows="3" id="" title="" class="CapLetter form-control" style="width:70%;"><?php echo set_value('cand_addr'); ?></textarea>
                                      <br />
                                      <em>
                                        <span class="form_error"><?php echo form_error('cand_addr'); ?></span>
                                      </em>
                                  </td>
                              </tr>

                              <tr>
                                  <td align="right" style="width: 30%;">
                                      <span id="">Office where working at present</span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                  </td>
                                  <td align="left" style="width: 70%;">
                                      <textarea name="cand_office"  rows="3" id="" title="" class="CapLetter form-control" style="width:70%;" /><?php echo set_value('cand_office'); ?></textarea>
                                      <br />
                                      <em>
                                        <span class="form_error"><?php echo form_error('cand_office'); ?></span>
                                      </em>

                                  </td>
                              </tr>


                              <tr>
                                  <td align="right" style="width: 30%;">
                                      <span id="">Mobile Number </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                  </td>
                                  <td align="left" style="width: 70%;">
                                      <div class="form-inline">
                                          <span id="" class="form-control" maxlength="3" readonly="True" style="display:inline-block;color:Navy;width:50px;">+91 </span>
                                          -
                                          <input name="cand_mob" value="<?php echo set_value('cand_mob'); ?>" type="text" maxlength="10" id="" title="Please Enter only 10 digit mobile number" class="form-control" style="width:250px;">
                                      </div>
                                      <span id="" class="bg-warning" style="color:Red;display:none;">Plesae Type Mobile Number.</span><span id="" class="bg-warning" style="color:Red;visibility:hidden;">Invalid Mobile Number</span>
                                      <br />
                                      <em><span style="color: #7d7e7f">( Please enter your personal Mobile Number)</span>

                                     <span class="form_error"><?php echo form_error('cand_mob'); ?></span>


                                      </em>
                                  </td>
                              </tr>

                              <tr>
                                  <td align="right" style="width: 30%;">
                                      <span id="">E-mail Address </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                  </td>
                                  <td align="left" style="width: 70%;">
                                      <input name="cand_email" value="<?php echo set_value('cand_email'); ?>" type="text" maxlength="50" id="" title="Please Type Email Id" class="form-control" style="width:300px;">

                                      <span id="" class="bg-warning" style="color:Red;display:none;">Plesae Type Valid Email ID.</span>
                                      <span id="" class="bg-warning" style="color:Red;visibility:hidden;">Invalid E-mail ID</span>
                                      <br>
                                      <em><span style="color: #7d7e7f">( Please enter your personal E-mail Address)</span>
                                        <span class="form_error"><?php echo form_error('cand_email'); ?></span>
                                      </em>
                                  </td>
                              </tr>

                              <tr>
                                  <td align="right" style="width: 30%;">
                                      <span id="">Landline </span><span style="font-size: medium; color: #CC0000"></span>
                                  </td>
                                  <td align="left" style="width: 70%;">
                                      <div class="form-inline">
                                          <input name="cand_landline" value="<?php echo set_value('cand_landline'); ?>" type="text" maxlength="14" id="" title="Please Enter only 10 digit mobile number" class="form-control" style="width:300px;">
                                      </div>
                                      <br />
                                      <em>
                                        <span class="form_error"><?php echo form_error('cand_landline'); ?></span>
                                                        </em>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="right" style="width: 30%;">
                                                        <span id="">Address for correspondence</span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                    </td>
                                                    <td align="left" style="width: 70%;">
                                                        <textarea name="cand_addr_corr"  type="text" rows="3" id="" title="" class="CapLetter form-control" style="width:70%;"><?php echo set_value('cand_addr_corr'); ?></textarea>
                                                        <br />
                                                        <em>
                                                          <span class="form_error"><?php echo form_error('cand_addr_corr'); ?></span>
                                                        </em>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="right" style="width: 30%;">
                                                        <span id="">PIN Code </span><span style="font-size: medium; color: #CC0000"></span>
                                                    </td>
                                                    <td align="left" style="width: 70%;">
                                                        <div class="form-inline">
                                                            <input name="cand_pincode" value="<?php echo set_value('cand_pincode'); ?>" type="text" maxlength="6" id="" title="" class="form-control" style="width:300px;">
                                                        </div>
                                                        <br />
                                                        <em>
                                                          <span class="form_error"><?php echo form_error('cand_pincode'); ?></span>
                                                        </em>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="right" style="width: 30%;">
                                                        <span id="">Date Of Birth (DD/MM/YYYY) </span>
                                                        <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                    </td>
                                                    <td align="left" style="width: 70%;">
                                                        <div class="form-inline">
                                                            <select name="day" id="" value="<?php echo set_value('day'); ?>" title="Please Select Day of DOB" class="form-control" style="width:100px;">
                                                              <?php $pd=set_value('day'); ?>
                                                                <option value="">DAY</option>
                                                                <?php for($i=1;$i<=31;$i++)
                                                                    { ?>
                                                                <option value="<?php echo $i; ?>" <?php if($pd==$i){
                                                                  echo "selected";
                                                                } ?> ><?php echo sprintf("%'.02d", $i); ?>
                                                              </option>
                                                              <?php } ?>

                                                            </select>
                                                            /&nbsp;<select name="mon" value="<?php echo set_value('mon'); ?>" id="" title="Please Select Month of DOB" class="form-control" style="width:100px;">
                                                              <?php
                                                              $MonthArray = array(
                    "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                    "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                    "9" => "September", "10" => "October", "11" => "November", "12" => "December",
                );
                                                              $pm=set_value('mon'); ?>
                                                                <option value="">MONTH</option>
                                                                <?php foreach ($MonthArray as $key => $value){ ?>


                                                                <option value="<?php echo $key;?>"<?php if($pm==$key){ echo "selected";} ?>><?php echo $value; ?></option>
                                                                <?php } ?>

                                                            </select>

                                                            <select name="year" value="<?php echo set_value('year'); ?>" id="" title="Please Select Year of DOB" class="form-control" style="width:100px;">
                                                              <?php $py=set_value('year'); ?>
                                                                <option value="">YEAR</option>
                                                                <?php for($i=1955;$i<=2003;$i++)
                                                                { ?>
                                                                <option value="<?php echo $i; ?>" <?php if($py==$i){ echo "selected";}  ?>><?php echo $i;?></option>
                                                              <?php } ?>


                                                            </select>


                                                            <span id="" style="color:Black;font-family:Times New Roman;font-weight:normal;"></span>
                                                            <br>
                                                            <em><span style="color: #7d7e7f">( Please Select your DOB As given in Matriculation Certificate.
                                                                    )</span></em>
                                                            <span id="" class="bg-warning" style="color:Red;display:none;"></span>
                                                            <span id="" class="bg-warning" style="color:Red;display:none;"></span>
                                                            <span id="" class="bg-warning" style="color:Red;display:none;"></span>
                                                            <span class="form_error"><?php echo form_error('day'); ?></span>
                                                            <span class="form_error"><?php echo form_error('mon'); ?></span>
                                                            <span class="form_error"><?php echo form_error('year'); ?></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>


                                    </td>
                                </tr>

                                <tr class="bg-info">
                                    <td colspan="2" class="heading2">
                                        <span>Educational qualifications (including professional qualification) ↓ </span>
                                        <input type="hidden" name="trow" id="tq" value="5">
                                    </td>
                                </tr>

                                <tr style="font-size: 12pt">
                                    <td colspan="2" style="text-align: left">
                                        <div style="text-align: left">
                                            <table id="dynamic_field" class="table table-bordered" style="width: 100%">
                                                <tbody>
                                                    <tr class="bg-danger">
                                                        <td align="left" style="font-weight: bold; color: white;" valign="top">Sr.No.</td>
                                                        <td align="left" style="font-weight: bold; color: white;" valign="top">Degree/Diploma</td>
                                                        <td align="left" style="font-weight: bold; color: white;" valign="top">Year</td>
                                                        <td align="left" style="font-weight: bold; color: white;" valign="top">Subjects taken</td>
                                                        <td align="left" style="font-weight: bold; color: white;" valign="top">University</td>
                                                        <td align="left" style="font-weight: bold; color: white;" valign="top">Division</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="" valign="top">
                                                            <strong>1.</strong>
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="deg[]" value="<?php echo set_value('deg[0]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="qyear[]" value="<?php echo set_value('qyear[0]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="sub[]" value="<?php echo set_value('sub[0]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="uni[]" value="<?php echo set_value('uni[0]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="div[]" value="<?php echo set_value('div[0]'); ?>" class="form-control" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="" valign="top">
                                                            <strong>2.</strong>
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="deg[]" value="<?php echo set_value('deg[1]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="qyear[]" value="<?php echo set_value('qyear[1]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="sub[]" value="<?php echo set_value('sub[1]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="uni[]" value="<?php echo set_value('uni[1]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="div[]" value="<?php echo set_value('div[1]'); ?>" class="form-control" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="" valign="top">
                                                            <strong>3.</strong>
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="deg[]" value="<?php echo set_value('deg[2]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="qyear[]" value="<?php echo set_value('qyear[2]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="sub[]" value="<?php echo set_value('sub[2]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="uni[]" value="<?php echo set_value('uni[2]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="div[]" value="<?php echo set_value('div[2]'); ?>" class="form-control" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="" valign="top">
                                                            <strong>4.</strong>
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="deg[]" value="<?php echo set_value('deg[3]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="qyear[]" value="<?php echo set_value('qyear[3]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="sub[]" value="<?php echo set_value('sub[3]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="uni[]" value="<?php echo set_value('uni[3]'); ?>" class="form-control" />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="div[]" value="<?php echo set_value('div[3]'); ?>" class="form-control" />
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <span class="pull-right"><button type="button" name="add" id="add" class="btn btn-success">Add</button></span>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="bg-info">
                                    <td colspan="2" class="heading2">
                                        <span> ↓ </span>
                                    </td>
                                </tr>

                                <tr style="font-size: 12pt">
                                    <td colspan="2" style="text-align: left">
                                        <div id="" style="width:100%;">
                                            <table style="width: 100%" class="table table-bordered">

                                                <tbody>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            Brief Service particulars / Experience / Organization (Please enclosed a sheet if necessary)
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <div class="form-inline">
                                                                <textarea name="cand_brief_service_perticular" value="<?php echo set_value('cand_brief_service_perticular'); ?>" type="text" rows="3" id="" title="" class="form-control" style="width:70%;"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            Details of experience of working in Health sector & E-health background
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <div class="form-inline">
                                                                <textarea name="cand_exp_in_health_sec" value="<?php echo set_value('cand_exp_in_health_sec'); ?>" type="text" rows="3" id="" title="" class="form-control" style="width:70%;"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            Whether SC/ST/OBC/Gen
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <div class="form-inline">
                                                                <select class="form-control" name="cand_cat" value="<?php echo set_value('cand_cat'); ?>">
                                                                  <?php $t=set_value('cand_cat'); ?>
                                                                    <option value="0">--Select--</option>
                                                                    <option value="1" <?php if($t==1){echo "selected";}?>>SC</option>
                                                                    <option value="2" <?php if($t==2){echo "selected";}?>>ST</option>
                                                                    <option value="3" <?php if($t==3){echo "selected";}?>>OBC</option>
                                                                    <option value="4" <?php if($t==4){echo "selected";}?>>General</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </td>
                                </tr>
                                <!--<tr>
                                    <td style="text-align: right; height: 30%;">
                                        <span id="">Enter Verification Code :</span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                    </td>
                                    <td style="text-align: left; height: 70%;">
                                        <div class="form-inline">
                                            <input name="captcha" id="captcha" type="text" maxlength="7" id="" title="Please Type Verification code" class="form-control" style="font-size:Large;width:150px;">
											<p id="captImg"><?php echo $captchaImg; ?></p>
                                            <span id="" class="bg-warning" style="color:Red;display:none;">Please Type Verification Code</span>
                                        </div>
                                    </td>
                                </tr>-->
                                <tr style="font-size: 12pt">
                                    <td style="text-align: left;" colspan="2">
                                        <div id="" class="bg-warning" style="color:Red; display:none;">
                                        </div>
                                        <span id="" style="display:inline-block; color:#FF0033; background-color:#FFFF66;font-size:12pt; width:100%;"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered" id="Table1">
                            <tbody>
                                <tr class="bg-info">
                                    <td colspan="2" style="text-align: center;">
                                        <input type="submit" name="" value="Validate &amp; Preview" onclick="" id="" class="btn btn-success" style="font-weight:bold;width:250px;">
                                        &nbsp;<input type="submit" name="" value="Cancel" id="" class="btn btn-warning" style="width:150px;">
                                        &nbsp;<input type="submit" name="" value="Close" id="" class="btn btn-danger" style="width:150px;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                      </form>
					
                    </div>
                </div>
                <div class="panel-heading">
                    <div class="alert-info">
                        <span style="font-size: 10pt; color: #ff0000; background-color: #00ffcc">* All fields are Mandatory </span>
                        <br>
                        <span id="" style="display:inline-block;color:Red;background-color:Yellow;font-size:13pt;width:100%;"></span>
                        <br>
                    </div>
                </div>
				<?php } else{?>
				   <div class="panel-body postClose">
                        <div id="" style="text-align: left; background-color: White; width: 100%">
						<img src="<?php echo site_url('assets/images/postClose.jpg') ?>" alt="Post Close" /> <span class="closedDate">This post has been closed 01/07/2020</span>
					    </div>
					</div>
				<?php } ?>
            </div>
        </div>
        <!-- Main body End Here -->
    </div>
</div>

<script>
    $(document).ready(function() {
		var inputCaptcha = $("#captcha").val();
		var sessCaptcha = '<?php echo $this->session->userdata('captchaCode') ?>';
		
  
  $("#notification-forms").validate({
    rules: {
      image: "required",
      signature: "required",
	    cand_name: {
		            required:true,
                lettersonly: true
            },
      cand_addr: "required",
      cand_office: "required",
      cand_mob: {
		   required:true,
		   minlength:10,
		   maxlength:10,
		   number: true
	  },
      cand_email: {
        required: true,
        email: true
      },
	  cand_addr_corr: "required",
	  day: {
       required:true
    },
	  mon: "required",
	  mon: "required",
	  year: "required",
    },
    // Specify validation error messages
    messages: {
      image: "Please upload your current Photograph",
      signature: "Please upload your Signature",
	  "cand_name": {
				required: "Please enter your name",
				lettersonly: "Please enter valid name"
			},
      cand_addr: "Please enter your Addresss",
      cand_office: "Please enter Office where working at present",
      cand_mob: "Please enter valid Mobile No.",
      cand_email: "Please enter a valid email address",
      cand_addr_corr: "Please enter Your correspondence address",
      day: "Please select day",
      mon: "Please select month",
      year: "Please select year",
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

		
		
        var i = 5;

        $('#add').click(function() {
            b = i++;
            $('#dynamic_field').append('<tr id="row' + b + '"><td><strong>' + b + '.</strong></td><td><input type="text" name="deg[]"  class="form-control" /></td><td><input type="text" name="year[]" class="form-control" /></td><td><input type="text" name="sub[]" class="form-control" /></td><td><input type="text" name="uni[]" class="form-control" /></td><td><input type="text" name="div[]" class="form-control" style="width:80%; float:left"/> <button type="button" name="remove" id="' + b + '" class="btn btn-danger btn_remove" style="width:16%;  float:right">X</button></td></tr>');
            $('#tq').val(b);
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

    });
</script>
