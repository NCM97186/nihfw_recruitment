<div class="contact-page-area padding-bottom">
    <div class="container">
        <div id="tab" class="container" style="text-align: center">
            <div class="panel panel-info national_form_border">
                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%">
                      <?php //echo "<pre>";print_r($qualification); die; ?>
                      <form method="post" action="<?php echo site_url() ?>" enctype="multipart/form-data">
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
                                                        <span style="color:Maroon;"><?php if(isset($results[0])){ echo $results[0]->adver_no; }else{ echo set_value('adver_no');}?></span>
                                                        <input type="hidden" id="" name="adver_no" value="<?php echo isset($results) ? set_value("adver_no", $results[0]->adver_no) : set_value("adver_no"); ?>">
                                                    </td>

                                                    <td style="text-align: left; width: 20%; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                        <span id="" style="color:#4658a9;font-weight:bold;">Examination Name : </span>
                                                    </td>
                                                    <td style="text-align: left; width: 30%; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                        <span style="color:Maroon;"><?php if(isset($results[0])) {echo $results[0]->post_name; } else{ echo set_value('post_name');}?></span>
                                                        <input type="hidden" id="" name="post_name" value="<?php echo isset($results) ? set_value("post_name", $results[0]->post_name) : set_value("post_name");  ?>">
                                                        <input type="hidden" id="" name="post_id" value="<?php echo isset($results) ? set_value("post_id", $results[0]->post_id) : set_value("post_id");  ?>">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="text-align: left; width: 20%; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                        <span id="" style="color:#4658a9;font-weight:bold;">Applied For : </span>
                                                    </td>
                                                    <td style="text-align: left; width: 30%; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                        <span id="" style="color:Maroon;">परीक्षा-2020,</span>
                                                    </td>
                                                    <td style="text-align: left; width: 30%; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                        <span id="" style="color:#4658a9;font-weight:bold;">Date for Calculating Age :</span>
                                                    </td>
                                                    <td style="text-align: left; width: 30%; background-color: rgba(248, 54, 42, 0.1411764705882353)">
                                                        <span id="" style="color:Maroon;font-weight:normal;">01/07/2020</span>

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

                                      <span id="">Name of the applicant </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                  </td>
                                  <td align="left" style="width: 70%;">
                                      <input name="cand_name" type="text" maxlength="50" id="" title="Please Type Candidate Name, Do not entered Mr./Mrs./Km./Dr./Er. etc. in Prefix of your Name " class="CapLetter form-control" style=" width:70%;" value="<?php echo $results[0]->cand_name; ?>" readonly>
                                      <br />
                                      <em><span style="color: #7d7e7f"></span>
                                        <span class="form_error"><?php echo form_error('cand_name'); ?></span>
                                      </em>
                                  </td>
                              </tr>
                              <tr>
                                <td>
                                  <div>

  <p>Candidate Photograph & Signature:</p>

</div>
                                </td>
                                <td>
                                  <div class="container">

  <img src="<?php echo base_url('uploads/'.$results[0]->image) ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
  <img src="<?php echo base_url('uploads/'.$results[0]->signature) ?>" class="img-thumbnail" alt="Cinque Terre" width="300" height="100">
</div>
                                </td>
                              </tr>

                              <tr>
                                  <td align="right" style="width: 30%;">
                                      <span id="">Address </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>

                                  </td>
                                  <td align="left" style="width: 70%;">
                                      <textarea readonly name="cand_addr"  rows="3" id="" title="" class="CapLetter form-control" style="width:70%;"><?php echo $results[0]->cand_addr; ?></textarea>
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
                                      <textarea readonly name="cand_office"  rows="3" id="" title="" class="CapLetter form-control" style="width:70%;" /><?php echo $results[0]->cand_office; ?></textarea>
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
                                          <input name="cand_mob" value="<?php echo $results[0]->cand_mob; ?>" type="text" maxlength="10" id="" title="Please Enter only 10 digit mobile number" class="form-control" style="width:250px;" readonly>
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
                                      <input name="cand_email" value="<?php echo $results[0]->cand_email; ?>" type="text" maxlength="50" id="" title="Please Type Email Id" class="form-control" style="width:300px;" readonly>

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
                                          <input name="cand_landline" value="<?php echo $results[0]->cand_landline; ?>" type="text" maxlength="14" id="" title="Please Enter only 10 digit mobile number" class="form-control" style="width:300px;" readonly>
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
                                                        <textarea readonly name="cand_addr_corr"  type="text" rows="3" id="" title="" class="CapLetter form-control" style="width:70%;"><?php $results[0]->cand_addr_corr; ?></textarea>
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
                                                            <input name="cand_pincode" value="<?php echo $results[0]->cand_pincode; ?>" type="text" maxlength="6" id="" title="" class="form-control" style="width:300px;" readonly>
                                                        </div>
                                                        <br />
                                                        <em>
                                                          <span class="form_error"><?php echo form_error('cand_pincode'); ?></span>
                                                        </em>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="right" style="width: 30%;">
                                                        <span id="">Date Of Birth </span>
                                                        <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                    </td>
                                                    <td align="left" style="width: 70%;">
                                                      <div class="form-inline">
                                                          <input name="cand_dob" value="<?php echo $results[0]->cand_dob; ?>" type="text" maxlength="6" id="" title="" class="form-control" style="width:300px;" readonly>
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
                                                    <?php for($i=0;$i<count($qualification);$i++){?>
                                                    <tr>
                                                        <td align="left" style="" valign="top">
                                                            <strong><?php echo ($i+1)."." ?></strong>
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="deg" value="<?php echo $qualification[$i]->degree; ?>" class="form-control" readonly />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="qyear" value="<?php echo $qualification[$i]->year; ?>" class="form-control" readonly/>
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="sub" value="<?php echo $qualification[$i]->subject; ?>" class="form-control" readonly />
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="uni" value="<?php echo $qualification[$i]->univ; ?>" class="form-control" readonly/>
                                                        </td>
                                                        <td align="left" style="" valign="top">
                                                            <input type="text" name="div" value="<?php echo $qualification[$i]->division; ?>" class="form-control" readonly />
                                                        </td>
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>

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
                                                                <textarea readonly name="cand_brief_service_perticular" value="<?php echo $results[0]->cand_brief_service_perticular; ?>" type="text" rows="3" id="" title="" class="form-control" style="width:70%;"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            Details of experience of working in Health sector & E-health background
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <div class="form-inline">
                                                                <textarea readonly name="cand_exp_in_health_sec" value="<?php echo $results[0]->cand_exp_in_health_sec; ?>" type="text" rows="3" id="" title="" class="form-control" style="width:70%;"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right" style="width: 30%;">
                                                          <span id="">Candidate Category </span><span style="font-size: medium; color: #CC0000"></span>
                                                      </td>
                                                      <td align="left" style="width: 70%;">
                                                          <div class="form-inline">
                                                              <input name="cand_cat" value="<?php if($results[0]->cand_cat=='1'){echo "SC";}
                                                              else if($results[0]->cand_cat=='2'){echo "ST";}
                                                              else if($results[0]->cand_cat=='3'){echo "OBC";}
                                                              else if($results[0]->cand_cat=='4'){echo "General";}
                                                               ?>" type="text" maxlength="6" id="" title="" class="form-control" style="width:300px;" readonly>
                                                          </div>
                                                          <br />
                                                          <em>
                                                            <span class="form_error"><?php echo form_error('cand_cat'); ?></span>
                                                          </em>
                                                      </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </td>
                                </tr>


                            </tbody>
                        </table>

                        <table class="table table-bordered" id="Table1">
                            <tbody>
                                <tr class="bg-info">
                                    <td colspan="2" style="text-align: center;">
                                        <input type="button" name="" value="Print" onclick="myApp.printTable()"  class="btn btn-success" style="font-weight:bold;width:250px;">
                                        &nbsp;
                                        <input type="button"  class="btn btn-warning" style="width:150px;" onclick="tableToExcel('tab', 'W3C Example Table')" value="Export to Excel">
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
                        <span style="font-size: 10pt; color: #ff0000; background-color: #00ffcc">*Text </span>
                        <br>
                        <span id="" style="display:inline-block;color:Red;background-color:Yellow;font-size:13pt;width:100%;"></span>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main body End Here -->
    </div>
</div>

<script>
    $(document).ready(function() {


    });
</script>
<script>
var myApp = new function () {
        this.printTable = function () {
            var tab = document.getElementById('tab');
            var win = window.open('', '', 'height=700,width=700');
            win.document.write(tab.outerHTML);
            win.document.close();
            win.print();
        }
    }
</script>
<script>
    var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
