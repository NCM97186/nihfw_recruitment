<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);

?>
<div class="btn offbtn">
<a href="<?php echo base_url() . "user/logout"; ?>"">Logout</a>
    </div>
<div class="contact-page-area container-fluid padding-bottom">
     <?php $this->load->view('common/user_tab.php');  ?>
    <div class="container">
        <?php $this->load->view('common/messages.php');  ?>
        <div id="national_form" class="container" style="text-align: center">

            <div class="panel panel-info national_form_border">

                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%">

                        <form method="post" action="<?php echo base_url('dashboard/success')?>" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />    
                        <table class="table table-bordered" id="tbl_Candidate">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align: left; width: 100%;">
                                            <table align="left" class="table table-bordered" style="width: 100%" id="tblcndt">
                                                <tbody>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">First Name </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            
                                                            <input name="first_name" type="text"  class="CapLetter form-control" style=" width:70%;" value="<?php echo set_value("first_name", @$basic_info->first_name); ?>">
                                                            <br />
                                                            <em>
                                                                <span class="form_error"><?php echo form_error('first_name'); ?></span>
                                                            </em>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">

                                                            <span id="">Middle Name </span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="middel_name" type="text" class="CapLetter form-control" style=" width:70%;" value="<?php echo set_value("middel_name", @$basic_info->middel_name); ?>">
                                                            <br />
                                                            <em>
                                                                <span class="form_error"><?php echo form_error('middel_name'); ?></span>
                                                            </em>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">

                                                            <span id="">Last Name </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="last_name" type="text"  class="CapLetter form-control" style=" width:70%;" value="<?php echo set_value("last_name", @$basic_info->last_name); ?>">
                                                            <br />
                                                            <em><span style="color: #7d7e7f">( Do not enter Mr./Mrs./Km./Dr./Er. etc. in Prefix of your Name )</span>
                                                                <span class="form_error"><?php echo form_error('last_name'); ?></span>
                                                            </em>
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span >Mobile No </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
															
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <div class="form-inline">
                                                                <span class="form-control" maxlength="3" readonly="True" style="display:inline-block;color:Navy;width:50px;">+91 </span>
                                                                -
                                                                <input name="cand_mob" type="text" maxlength="10" value="<?php echo set_value("cand_mob", @$basic_info->cand_mob); ?>" class="form-control" style="width:250px;" readonly>
                                                            </div>
                                                           
                                                            <br />
                                                            <em><span style="color: #7d7e7f">( Please enter your personal Mobile Number)</span>

                                                                <span class="form_error"><?php echo form_error('cand_mob'); ?></span>


                                                            </em>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">E-mail ID </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="cand_email" value="<?php echo set_value("cand_email", @$basic_info->cand_email); ?>" type="text" maxlength="50" id="" title="Please Type Email Id" class="form-control" style="width:300px;" readonly>
                                                            <br>
                                                            <em><span style="color: #7d7e7f">( Please enter your personal E-mail Address)</span>
                                                                <span class="form_error"><?php echo form_error('cand_email'); ?></span>
                                                            </em>
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
                                    <tr class="bg-info" >
                                        <td colspan="2" style="text-align: center;">
                                            <input type="submit" name="basicinfo" value="Save & Next" onclick="" id="" class="btn btn-success" style="font-weight:bold;width:250px;">
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
