<?php
/*
echo '<pre>';
print_r($work_experience);

echo '</pre>';
*/
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

                <div class="panel panel-info national_form_border">

                    <div class="panel-body">
                        <div id="" style="text-align: left; background-color: White; width: 100%">
                            <?php
                            $attributes = array('name' => 'details_form', 'id' => 'details_form', 'onsubmit' => "return SubmitForm()");
                            $action =   base_url() . "dashboard/details/";
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
                            echo form_open_multipart($action, $attributes);
                            if (isset($user_details->id)) {
                                $detailId = $user_details->id;
                            } else {
                                $detailId = '';
                            }
                           
                            ?>
                            <!-- <input type="hidden" name="detailId" value="<?php echo $detailId ?>">-->
                            <table class="table table-bordered">
                                <tbody>
                                    

                                    <tr class="bg-info">
                                        <td colspan="2" class="heading2">
                                            <span>Details of Educational and other professional / Technical qualifications ↓</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" style="background: #fff; font-size: 15px; color: red;">NOTE: The date of passing eligibility examination will be the date appearing on the marksheet or provisional certificate issued by the University / Institute. In case the result of a particular examination is posted on the website of the University / Institute, a certificate issued by the appropriate authority of the University / Institute indicating the date on which the result was posted on the website will be taken as the date of passing.</td>
                                    </tr>

                                    <tr style="font-size: 12pt">
                                        <td colspan="2" style="text-align: left">
                                            <div style="text-align: left">
                                                <table id="dynamic_field" class="table table-bordered" style="width: 100%">
                                                    <tbody>
                                                        <tr class="bg-danger">
                                                            <!-- <td align="left" style="font-weight: bold; color: white;" valign="top">Sr.No.</td> -->
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Examination/Degree and Subjects</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Board/ University</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Year of Passing</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Max. Marks</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Marks Obtained </td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Percentage </td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Certificate / Mark Sheet</td>
                                                        </tr>
                                                        <?php
                                                        $i = 0;

                                                        if (!empty($degree_diploma)) {
                                                            foreach ($degree_diploma as $value) {
                                                                $i++; ?>
                                                                <tr id="row<?php echo $i ?>">
                                                                    <!-- <td align="left" style="" valign="top">
                                                                        <strong><?php //echo $i 
                                                                                ?>.</strong>
                                                                    </td> -->
                                                                    <td align="left" style="" valign="top">
                                                                        <input type="hidden" name="degree_diploma[degree_id][<?php echo $i ?>]" value="<?php echo @$value->degree_id; ?>" class="form-control">

                                                                        <input type="text" name="degree_diploma[deg][<?php echo $i ?>]" value="<?php echo @$value->deg; ?>" class="form-control">
                                                                        <span class="form_error"><?php echo @$value->deg_error; ?></span>
                                                                    </td>
                                                                    <td align="left" style="" valign="top">
                                                                        <input type="text" id="degree_diploma_<?php echo $i ?>" onkeypress="return onlyAlphabets(event,this);"  onchange="checkValueN(<?php echo $i; ?>)"
                                                                        name="degree_diploma[year][<?php echo $i ?>]" value="<?php echo @$value->year; ?>" class="form-control">
                                                                        <span class="form_error"><?php echo @$value->year_error; ?></span>
                                                                    </td>
                                                                    <td align="left" style="" valign="top">
                                                                        <input type="text"  id="degree_diploma_year_<?php echo $i ?>" name="degree_diploma[sub][<?php echo $i ?>]" maxlength="4" onchange="checkValueddate(<?php echo $i; ?>)" onkeypress="return validateNumber(event)" value="<?php echo @$value->sub; ?>" class="form-control">
                                                                        <span class="form_error"><?php echo @$value->year_error; ?></span>
                                                                    </td>
                                                                    <td align="left" style="" valign="top">
                                                                        <input type="text" id="degree_diploma_uni_add_<?php echo $i; ?>" onchange="checkValueN(<?php echo $i; ?>)" onkeypress="return validateNumber(event)" name="degree_diploma[uni][<?php echo $i ?>]" value="<?php echo @$value->uni; ?>" class="form-control maxmarks">
                                                                        <span class="form_error"><?php echo @$value->uni_error; ?></span>
                                                                    </td>
                                                                    <td align="left" style="" valign="top">
                                                                        <input type="text" id="edu_div_add_<?php echo $i; ?>" onchange="checkValueN(<?php echo $i; ?>)" onkeypress="return validateNumber(event)" name="degree_diploma[div][<?php echo $i ?>]" value="<?php echo @$value->div; ?>" class="form-control obtainmarks" style="width:80%; float:left" data-log>
                                                                        <span class="form_error"><?php echo @$value->div_error; ?></span>
                                                                        <span id="obtain_add_<?php echo $i; ?>" style="color:red"></span>
                                                                    </td>
                                                                    <td align="left" style="" valign="top">
                                                                        <input type="text" id="edu_div_per_<?php echo $i; ?>" onchange="checkValueN(<?php echo $i; ?>)" name="degree_diploma[per][<?php echo $i ?>]" value="<?php echo @$value->per; ?>" class="form-control obtainper" style="width:80%; float:left" data-log readonly>
                                                                        <span class="form_error"><?php //echo form_error('degree_diploma[per][]'); 
                                                                                                    ?></span>
                                                                    </td>
                                                                    <td align="left" style="" valign="top">
                                                                        <input type="file" name="education_file[education_file][<?php echo $i ?>]" value="" onchange="onlyeducationpdf(this,<?php echo $i; ?>);" class="form-control" />
                                                                        <span class="form_error"><?php echo @$value->file_error; ?></span>
                                                                        <span class="education_doc_<?php echo $i; ?>_error" style="color:red;"></span>
                                                                        <span style="font-size:13px">Please select pdf format file<br>max file size 1MB</span>
                                                                        <button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn_remove" style="width:16%;  float:right">X</button>
                                                                    </td>
                                                                </tr>
                                                            <?php  }
                                                        } else {
                                                            $i = 1; ?>
                                                            <tr id="row<?php echo $i ?>">
                                                                <!-- <td align="left" style="" valign="top">
                                                                    <strong><?php //echo $i 
                                                                            ?>.</strong>
                                                                </td> -->
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" name="degree_diploma[deg][<?php echo $i ?>]" value="<?php echo set_value('degree_diploma[deg]'); ?>" class="form-control">
                                                                    <span class="form_error"><?php echo form_error('degree_diploma[deg]'); ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" onkeypress="return onlyAlphabets(event,this);" name="degree_diploma[year][<?php echo $i ?>]" value="<?php echo @$value->year; ?>" class="form-control">
                                                                    <span  id="degree_diploma_<?php echo $i ?>"  class="form_error"><?php echo form_error('degree_diploma[year]'); ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" onkeypress="return validateNumber(event)" onchange="checkValueddate(<?php echo $i; ?>)" id="degree_diploma_year_<?php echo $i ?>"
                                                                     name="degree_diploma[sub][<?php echo $i ?>]"  value="<?php echo @$value->sub; ?>" 
                                                                     class="form-control" maxlength="4">
                                                                    <span class="form_error"><?php echo form_error('diploma_year_<?php echo $i; ?>'); ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" id="degree_diploma_uni_add_<?php echo $i; ?>" onchange="checkValueN(<?php echo $i; ?>)" onkeypress="return validateNumber(event)" name="degree_diploma[uni][<?php echo $i ?>]" value="<?php echo @$value->uni; ?>" class="form-control maxmarks">
                                                                    <span class="form_error"><?php echo form_error('degree_diploma[uni]'); ?></span>

                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" id="edu_div_add_<?php echo $i; ?>" onchange="checkValueN(<?php echo $i; ?>)" onkeypress="return validateNumber(event)" name="degree_diploma[div][<?php echo $i ?>]" value="<?php echo @$value->div; ?>" class="form-control obtainmarks" style="width:80%; float:left">
                                                                    <span class="form_error"><?php echo form_error('degree_diploma[div]'); ?></span>
                                                                    <span id="obtain_add_<?php echo $i; ?>" style="color:red"></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" id="edu_div_per_<?php echo $i; ?>" onchange="checkValueN(<?php echo $i; ?>)" name="degree_diploma[per][<?php echo $i ?>]" value="<?php echo @$value->div; ?>" class="form-control obtainmarks" style="width:80%; float:left" readonly>
                                                                    <span class="form_error"><?php echo form_error('degree_diploma[per]'); ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="file" name="education_file[education_file][<?php echo $i ?>]" value="" id="education_doc_<?php echo $i; ?>" onchange="onlyeducationpdf(this,<?php echo $i; ?>);" class="form-control" />
                                                                    <span class="form_error"><?php echo !empty($file_error) ? $file_error : ''; //form_error('education_file[education_file][]'); 
                                                                                                ?></span>
                                                                    <span class="education_doc_<?php echo $i; ?>_error" style="color:red;"></span>
                                                                    <span style="font-size:13px">Please select pdf format file<br>max file size 1MB</span>
                                                                    <button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn_remove" style="width:16%;  float:right">X</button>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <input type="hidden" id="tq" value="<?php echo $i ?>" />
                                                    </tbody>
                                                </table>
                                                <span class="pull-right"><button type="button" name="add" id="add" class="btn btn-success">Add</button></span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="bg-info">
                                        <td colspan="2" class="heading2">
                                            <span>Details of Employment (Start from present Employer) ↓ </span>
                                        </td>
                                    </tr>
                                    <tr style="font-size: 12pt">
                                        <td colspan="2" style="text-align: left">
                                            <div style="text-align: left">
                                                <table id="dynamic_field_work" class="table table-bordered" style="width: 100%">
                                                    <tbody>
                                                        <tr class="bg-danger">
                                                            <!-- <td align="left" style="font-weight: bold; color: white;" valign="top">Sr.No.</td> -->
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Organization</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Post Held</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Pay Scale and Basic Pay </td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">From </td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">To</td>
                                                            <td align="left" style="font-weight: Medium; color: white;" valign="top">Appointment Order</td>
                                                        </tr>
                                                        <?php
                                                        $i = 1;
                                                        $user_work_experience = $work_experience;
                                                        if (!empty($user_work_experience)) {
                                                            foreach ($user_work_experience as $value) { ?>
                                                                <tr id="rowwork<?php echo $i ?>">
                                                                    <!-- <td align="left" style="" valign="top">
                                                                        <strong><?php //echo $i 
                                                                                ?>.</strong>
                                                                    </td> -->
                                                                    <td align="left" style="" valign="top">
                                                                        <input type="hidden" name="work_experience[work_experience_id][]" value="<?php echo @$value->work_experience_id; ?>" class="form-control">

                                                                        <input type="text" name="work_experience[organization][]" value="<?php echo @$value->organization; ?>" class="form-control">
                                                                        <span class="form_error"><?php //echo form_error('organization[]'); 
                                                                                                    ?></span>
                                                                    </td>
                                                                    <td align="left" style="" valign="top">
                                                                        <input type="text" name="work_experience[post_held][]" value="<?php echo @$value->post_held; ?>" class="form-control" onkeypress="return ValidateAlphnumeric(event);">
                                                                        <span class="form_error"><?php //echo form_error('post_held[]'); 
                                                                                                    ?></span>
                                                                    </td>
                                                                    <td align="left" style="" valign="top">
                                                                        <input type="text" name="work_experience[pay_scale][]" value="<?php echo @$value->pay_scale; ?>" class="form-control" onkeypress="return validateNumber(event)">
                                                                        <span class="form_error"><?php //echo form_error('work_experience[pay_scale][]'); 
                                                                                                    ?></span>
                                                                    </td>
                                                                    <td align="left" style="" valign="top">
                                                                        <input type="date"  min="1940-01-01" max="<?php echo date('Y-m-d'); ?>" class="work_experience_from_<?php echo $i ?>" name="work_experience[from_date][]" onchange="ValidateFromdate(<?php echo $i ?>);" id="work_experience_from_<?php echo $i ?>" value="<?php if (!empty($value->from_date)) {
                                                                                                                                                                                                                                                                                    echo date_convert_normal_to_mysql($value->from_date);
                                                                                                                                                                                                                                                                                } ?>" class="form-control">
                                                                        <span class="work_experience_From_error_<?php echo $i; ?>" style="color:red;"></span>
                                                                        <span class="form_error"><?php //echo form_error('work_experience[from_date][]'); 
                                                                                                    ?></span>
                                                                    </td>
                                                                    <td align="left" style="" valign="top">
                                                                        <input type="date" min="1980-01-01" max="<?php echo date('Y-m-d'); ?>" name="work_experience[to_date][]" onchange="ValidateTodate(<?php echo $i ?>);" id="work_experience_to_<?php echo $i ?>" class="work_experience_to_<?php echo $i ?>" value="<?php if (!empty($value->to_date)) {
                                                                                                                                                                                                                                                                            echo date_convert_normal_to_mysql($value->to_date);
                                                                                                                                                                                                                                                                        } ?>" class="form-control" style="width:100%; float:left">
                                                                        <span class="work_experience_to_error_<?php echo $i; ?>" style="color:red;"></span>
                                                                        <span class="form_error"><?php //echo form_error('work_experience[to_date][]'); 
                                                                                                    ?></span>

                                                                    </td>
                                                                    <td align="left" style="" valign="top">
                                                                        <input type="file" name="organization_file[organization_file][]" id="organization_doc_<?php echo $i; ?>" onchange="onlyorganizationpdf(this,<?php echo $i; ?>);" class="form-control" />
                                                                        <span class="organization_doc_<?php echo $i; ?>_error" style="color:red;"></span>
                                                                        <span style="font-size:13px">Please select pdf format file<br>max file size 1MB</span>
                                                                        <button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn_remove_work" style="width:16%;  float:right">X</button>
                                                                    </td>
                                                                </tr>
                                                            <?php $i++;
                                                            }
                                                        } else { ?>
                                                            <tr id="rowwork<?php echo $i ?>">
                                                                <!-- <td align="left" style="" valign="top">
                                                                    <strong><?php //echo $i 
                                                                            ?>.</strong>
                                                                </td> -->
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" name="work_experience[organization][]" value="" class="form-control">
                                                                    <span class="form_error"><?php //echo form_error('organization[]'); 
                                                                                                ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" name="work_experience[post_held][]" onkeypress="return onlyAlphabets(event,this);" value="" class="form-control">
                                                                    <span class="form_error"><?php //echo form_error('post_held[]'); 
                                                                                                ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="text" name="work_experience[pay_scale][]" onkeypress="return validateNumber(event)" value="" class="form-control">
                                                                    <span class="form_error"><?php //echo form_error('work_experience[pay_scale][]'); 
                                                                                                ?></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="date"  min="1980-01-01" max="<?php echo date('Y-m-d'); ?>"  id="work_experience_from_<?php echo $i; ?>" onchange="ValidateFromdate(<?php echo $i ?>);" id="work_experience_from_<?php echo $i ?>"  name="work_experience[from_date][]" value="" class="form-control">
                                                                    <span class="form_error"><?php echo form_error('work_experience[from_date][]'); 
                                                                                                ?></span>
                                                                    <span class="work_experience_From_error_<?php echo $i; ?>" style="color:red;"></span>

                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="date" min="1980-01-01" max="<?php echo date('Y-m-d'); ?>" name="work_experience[to_date][]" onchange="ValidateTodate(<?php echo $i ?>);" id="work_experience_to_<?php echo $i; ?>" value="" class="form-control" style="width:100%; float:left">
                                                                    <span class="form_error"><?php echo form_error('work_experience[to_date][]'); 
                                                                                                ?></span>
                                                                                                <span class="work_experience_to_error_<?php echo $i; ?>" style="color:red;"></span>
                                                                </td>
                                                                <td align="left" style="" valign="top">
                                                                    <input type="file" name="organization_file[organization_file][]" id="organization_doc_<?php echo $i; ?>" onchange="onlyorganizationpdf(this,<?php echo $i; ?>);" class="form-control" />
                                                                    <span class="organization_doc_<?php echo $i; ?>_error" style="color:red;"></span>
                                                                    <span style="font-size:13px">Please select pdf format file<br>max file size 1MB</span>
                                                                    <button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn_remove_work" style="width:16%;  float:right">X</button>
                                                                </td>
                                                            </tr>
                                                        <?php  }  ?>
                                                        <input type="hidden" id="tq_work" value="<?php echo $i ?>" />
                                                    </tbody>
                                                </table>
                                                <span class="pull-right"><button type="button" name="add" id="addwork" class="btn btn-success">Add</button></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="font-size: 12pt">
                                        <td colspan="2" style="text-align: left">
                                            <div id="" style="width:100%;">
                                                <table style="width: 100%" class="table table-bordered">

                                                    <tbody>

                                                        <!-- <tr>
                                                            <td align="right" style="width: 30%;">
                                                                Are you employed, if so, give the name and the address of the Employer
                                                            </td>
                                                            <td align="left" style="width: 70%;">
                                                                <div class="form-inline">
                                                                    <textarea id="particulars_exp" name="particulars_exp" type="text" rows="3" class="form-control" style="width:70%;"><?php echo set_value("particulars_exp", @$user_details->particulars_exp); ?></textarea>
                                                                </div>
                                                            </td>
                                                        </tr> -->
                                                        <!-- <tr>
                                                            <td align="right" style="width: 30%;">
                                                                Any other relevant information
                                                            </td>
                                                            <td align="left" style="width: 70%;">
                                                                <div class="form-inline">
                                                                    <textarea id="details_of_exp" name="details_of_exp" type="text" rows="3" class="form-control" style="width:70%;"><?php echo set_value("details_of_exp", @$user_details->details_of_exp); ?></textarea>
                                                                </div>
                                                            </td>
                                                        </tr> -->
                                                        <!-- <tr>
                                                        <td align="right" style="width: 30%;">
                                                            List of enclosures
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <div class="form-inline">
                                                                <textarea name="list_of_enclosures" type="text" rows="3" class="form-control" style="width:70%;"><?php echo set_value("list_of_enclosures", @$user_details->list_of_enclosures); ?></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                        <!-- <tr>
                                                        <td align="right" style="width: 30%;">
                                                            Remarks of the employer if application is forwarded through proper channel
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <div class="form-inline">
                                                                <textarea name="remarks_of_employer" type="text" rows="3" class="form-control" style="width:70%;"><?php echo set_value("remarks_of_employer", @$user_details->remarks_of_employer); ?></textarea>
                                                            </div>
                                                        </td>
                                                    </tr> -->


                                                    </tbody>
                                                </table>

                                            </div>
                                        </td>
                                    </tr> 
                                   




                                                </tbody>
                                            </table>


                                        </td>
                                    </tr>

                                    <!-- <tr class="bg-info">
                                    <td colspan="2" class="heading2">
                                        <span>DECLARATION ↓ </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="background: #fff; font-size: 13px; color: #6969de;">I hereby decalre that I am citizen of India and all the statements made in the applications are true, complete and correct to the best of my knoeldge and belief. I have never been convicted by any court of law and no criminal case is pending against me in any court of law in the country. My certificates can be got verified at any time from the issuing authority. In the event of any information being found false/incorrect or ineligibility being detected before or after the written test/sill test or at any point of time, my candidature will stand automatically cancelled.</td>
                                </tr> -->

                                 
                                </tbody>
                            </table>

                            <table class="table table-bordered" id="Table1">
                                <tbody>
                                    <tr class="bg-info">
                                        <td colspan="2" style="text-align: center;">
                                            <input type="submit" name="validate" value="Validate &amp; Preview" class="btn btn-success" style="font-weight:bold;width:250px;">
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
        /* $(function() {
            $("#work_experience_from").datepicker({
                numberOfMonths: 2,
                onSelect: function(selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() + 1);
                    $("#work_experience_to").datepicker("option", "minDate", dt);
                }
            });
            $("#work_experience_to").datepicker({
                numberOfMonths: 2,
                onSelect: function(selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() - 1);
                    $("#work_experience_from").datepicker("option", "maxDate", dt);
                }
            });
        });*/
    </script>
    <script>
        $(document).ready(function() {
            var inputCaptcha = $("#captcha").val();
            var sessCaptcha = '<?php echo $this->session->userdata('captchaCode') ?>';


            $("#details_forms").validate({
                rules: {
                    category: "required",
                    benchmark: "required",
                    dob: "required",
                    gender: "required",
                    marital_status: "required",
                    father_name: "required",
                    mother_name: "required",
                    corr_address: "required",
                    corr_state: "required",
                    corr_pincode: "required",
                    perm_address: "required",
                    perm_state: "required",
                    perm_pincode: "required"
                },
                // Specify validation error messages
                messages: {
                    category: "Please Slect Category",
                    benchmark: "Please Select Are you a person with benchmark",
                    dob: "Please Select Date Of Birth",
                    gender: "Please Select gender",
                    marital_status: "Please Select Marital Status",
                    father_name: "Please enter Your Father's Name",
                    mother_name: "Please Mother's Name",
                    corr_address: "Please enter Address for Correspondence",
                    corr_state: "Please enter State ",
                    corr_pincode: "Please enter Pincode",
                    perm_address: "Please enter Permanent Address",
                    perm_state: "Please enter State",
                    perm_pincode: "Please enter Pincode"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });



            if ($('#tq').val() != '') {
                var i = parseInt($('#tq').val());
            } else {
                var i = 2;
            }
            var b = i;
            $('#add').click(function() {
                b = b + 1;
                $('#dynamic_field').append('<tr id="row' + b + '" class="edu_row"><td><input type="text"   name="degree_diploma[deg][]"  class="form-control" /></td><td><input type="text" name="degree_diploma[year][]" onkeypress="return onlyAlphabets(event,this);" class="form-control" /></td><td><input type="text" name="degree_diploma[sub][]" id="degree_diploma_year_' + b + '" onchange="checkValueddate(' + b + ')"  maxlength="4" onkeypress="return validateNumber(event)" class="form-control " /> <span id="diploma_year_' + b + '" style="color:red"></span> </td><td><input type="text" onkeypress="return validateNumber(event)" onchange="checkValueN(' + b + ')" id="degree_diploma_uni_add_' + b + '" name="degree_diploma[uni][]" class="form-control maxmarks" /></td><td><input type="text" id="edu_div_add_' + b + '" name="degree_diploma[div][]" onkeypress="return validateNumber(event)" onchange="checkValueN(' + b + ')" class="form-control obtainmarks" style="width:80%; float:left" data-log /><span id="obtain_add_' + b + '" style="color:red"></span><td><input type="text" id="edu_div_per_'+b+'" name="degree_diploma[per][]" onkeypress="return validateNumber(event)" onchange="checkValueN('+b+')" class="form-control obtainper" style="width:80%; float:left" data-log readonly /><td><input type="file" name="education_file[education_file][]" id="education_doc_'+b+'" onchange="onlyeducationpdf(this,'+b+');"  class="form-control" /><span class="education_doc_'+b+'_error" style="color:red;"></span>  <span style="font-size:13px">Please select pdf format file<br>max file size 1MB</span><button type="button" name="remove" id="' + b + '" class="btn btn-danger btn_remove" style="width:16%;  float:right">X</button></td></tr>');
            });
            if ($('#tq_work').val() != '') {
                var j = parseInt($('#tq_work').val());
            } else {
                var j = 1;
            }

            $('#addwork').click(function() {
                b = j + 1;
                $('#dynamic_field_work').append('<tr id="rowwork' + b + '" class="org_row"><td><input type="text" name="work_experience[organization][]" class="form-control" /></td><td><input type="text" name="work_experience[post_held][]" onkeypress="return ValidateAlphnumeric(event);" class="form-control" /></td><td><input type="text" name="work_experience[pay_scale][]" onkeypress="return validateNumber(event)"  class="form-control" /></td><td><input type="date" min="1940-01-01" max="<?php echo date('Y-m-d'); ?>" onchange="ValidateFromdate(' + b + ');"  id="work_experience_from_' + b + '" name="work_experience[from_date][]" class="form-control" /><span class="work_experience_From_error_' + b + '" style="color:red;"></span></td><td><input type="date" min="1980-01-01" max="<?php echo date('Y-m-d'); ?>" onchange="ValidateTodate(' + b + ');"  id="work_experience_to_' + b + '" name="work_experience[to_date][]" class="form-control" style="width:100%; float:left"/><span class="work_experience_to_error_' + b + '" style="color:red;"></span><td><input type="file" name="organization_file[organization_file][]"  class="form-control" id="organization_doc_' + b + '" onchange="onlyorganizationpdf(this,' + b + ');" /><span class="organization_doc_' + b + '_error" style="color:red;"></span>   <span style="font-size:13px">Please select pdf format file<br>max file size 1MB</span><button type="button" name="remove" id="' + b + '" class="btn btn-danger btn_remove_work" style="width:16%;  float:right">X</button></td></tr>');
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
            var returndata = calculated_year + " Years " + calculated_month + " Month and " + calculated_days + " Days "
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
                alert(diffDate);
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
                // const datePickerf = document.getElementById("work_experience_from");

                // datePickerf.min = getDate(10000000);
                // datePickerf.max = getDate();
      //  const datePicker = document.getElementById("dob");

        // datePicker.min = getDate(10000000);
        // datePicker.max = getDate();


        //const datePickerf = document.getElementById("work_experience_from");

        //datePickerf.min = getDate(10000000);
       // datePickerf.max = getDate();

        // const datePickerf1 = document.getElementById("work_experience_from1");

        // datePickerf1.min = getDate(10000000);
        // datePickerf1.max = getDate();

      //  const datePickert = document.getElementById("work_experience_to");

      //  datePickert.min = getDate(10000000);
        //datePickert.max = getDate();

        // const datePickert1 = document.getElementById("work_experience_to1");

        // datePickert1.min = getDate(10000000);
        // datePickert1.max = getDate();

        // Borrowed from https://stackoverflow.com/a/29774197/7290573
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
                var fd = new FormData($("#dob_doc"));
                //fd.append('file',myFile);
                
                var user_id=<?php echo $_SESSION['USER']['user_id']; ?>;
                var post_id=<?php echo $_COOKIE['post_id']; ?>;
                var path='dob_proof';
                fd.append('user_id',user_id);
                fd.append('post_id',post_id);
                fd.append('path',path);

                // $.ajax({
                //     url: "<?php echo base_url(); ?>/dashboard/upload_pdf",
                //     type: "POST",
                //     data:fd,
                //   //  data: "myFile="+myFile+"user_id="+user_id+"post_id="+post_id+"path="+path+",
                //     contentType: false,
                //     cache: false,
                //     processData:false,
                // });
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
       function checkfile(name,id)
        {
           if(id != " "){
            if(name== "photograph"){
             $('.checkphoto').html('Document has been uploaded successfully!!');
             $("#texthide").css("display", "none");
            
                 const [file] = imgInp.files
                if (file) {
                    blah.src = URL.createObjectURL(file)
                }
            }
            if(name== "signature"){
                $('.checksignature').html('Document has been uploaded successfully!!');
               
                $("#sigtexthide").css("display", "none");
                const [file] = sigimg.files
                if (file) {
                    sigimagpre.src = URL.createObjectURL(file)
                }

           }
           if(name== "photograph"){
            // $('.checkphoto').html('Document has been uploaded successfully!!');
                // imgInp.onchange = evt => {
                //     const [file] = imgInp.files
                //     alert(file);
                //     if (file) {
                //         blah.src = URL.createObjectURL(file)
                //     }
                // }
            }
        }
    }

        // function checksignature(id)
        // {
           
        //    if(id != " "){
        //     $('.checksignature').html('Document has been uploaded successfully!!');
        //    }else{
        //     $('.checksignature').html('');

        //    }

        // }
 
    </script>