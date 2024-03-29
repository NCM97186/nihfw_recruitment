<style>
    .copy-right-area{
        position:absolute;
        bottom:0;
        left:0;
        right:0;
    }
</style>
<div class="contact-page-area container-fluid padding-bottom">
    <div class="container">
        <div id="national_form" class="container" style="text-align: center">

            <div class="panel panel-info national_form_border">

                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%">
                        <?php $this->load->view('common/messages.php'); ?>
                        <form method="post" action="<?php echo base_url('user/verifyotp') ?>" enctype="multipart/form-data">
                            <table class="table table-bordered" id="tbl_Candidate">
                                <tbody>
                                <tr class="bg-info">
                                        <td colspan="2" class="heading2">
                                            <span>Verify OTP</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: left; width: 100%;">
                                            <table align="left" class="table table-bordered" style="width: 100%" id="tblcndt">
                                                <tbody>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Enter your OTP </span></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="id" type="text" class="CapLetter form-control" style=" width:70%;" value="<?php echo set_value('id'); ?>">
                                                            <br />
                                                            <em>
                                                                <span class="form_error"><?php echo form_error('id'); ?></span>
                                                            </em>
                                                        </td>

                                                    </tr>
                                                    
                                                   
                                                    <!-- <tr>
                                                        <td align="right" style="width: 30%;">

                                                            <span id="">Enter DOB </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="last_name" type="text" class="CapLetter form-control" style=" width:70%;" value="<?php echo set_value('last_name'); ?>">
                                                            <br />
                                                            <em><span style="color: #7d7e7f">( Do not enter Mr./Mrs./Km./Dr./Er. etc. in Prefix of your Name )</span>
                                                                <span class="form_error"><?php echo form_error('last_name'); ?></span>
                                                            </em>
                                                        </td>
                                                    </tr> -->


                                                   
                                                    <?php if ($this->config->item('captcha_enabled')) { ?>
                                                        <tr>
                                                            <td align="right" style="width: 30%;">
                                                                <span>Security Code</span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                            </td>
                                                            <td align="left" style="width: 70%;">

                                                                <input type="text" class="form-control" name="captcha" style="width:20%; float:left;     margin-right: 12px;">
                                                                <input type='hidden' name='code' value='<?php echo $captcha["word"]; ?>'>
                                                                <p id="captImg"><?php echo $captcha['image']; ?></p>
                                                                <a href="javascript:void(0);" class="refreshCaptcha"><img style="float:left; height: 23px; margin: 5px 11px" src="<?php echo base_url() ?>assets/img/refresh.png" /></a>

                                                                <span class="form_error"><?php echo form_error('captcha'); ?></span>

                                                            </td>
                                                        </tr>
                                                    <?php } ?>

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
                                            <input type="submit" name="register" value="Save" onclick="" id="" class="btn btn-success" style="font-weight:bold;width:250px;">
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
<!-- captcha refresh code -->
<script>
    jQuery(document).ready(function() {
        jQuery('.refreshCaptcha').on('click', function() {
            jQuery.get('<?php echo base_url() . 'login/refresh_captcha'; ?>', function(data) {
                $('#captImg').html(data);
            });
        });
    });
</script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/additional-methods.js"></script>-->