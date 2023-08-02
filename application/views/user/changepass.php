<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
?>


<div style="display:flex;">
<?php
  $this->load->view('user/sidebar.php');
?>

<div id="main" class="w-100 container">
<button class="openbtn" onclick="openNav()">☰</button>
            <div class="panel container panel-info national_form_border">

                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%">
                        <?php $this->load->view('common/messages.php'); ?>
                        <form method="post" action="<?php echo site_url('user/changePasswordProcess'); ?>">
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
                                <div class="form-group row">
                                    <label class="col-md-3" style="margin-top:10px; text-align: center;">Old Password <font color="red">*</font></label>
                                       
                                        <div class="col-md-8">
                                        <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control error">
                                        <span class="form_error"><?php echo form_error('old_password'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" style="margin-top:10px; text-align: center;">New Password <font color="red">*</font></label>
                                       
                                        <div class="col-md-8">
                                        <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control error">
                                        <span class="form_error"><?php echo form_error('new_password'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" style="margin-top:10px; text-align: center;">Confirm Password <font color="red">*</font></label>
                                       
                                        <div class="col-md-8">
                                        <input type="password" name="confirm_password" id="confirm_password" placeholder="New Password" class="form-control error">
                                        <span class="form_error"><?php echo form_error('confirm_password'); ?></span>
                                    </div>
                                </div>

                               <hr/>
                                    <div class="text-center">
                                        <button type="submit" id="changeform" onclick="return getPass();" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i> Save</button>
                                        <a  href="<?php echo site_url('/dashboard/UserDashboard') ?>" type="reset" id="srch" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
                                    </div>

                            </div>
                        </form>

                    </div>
              
        </div>
        <!-- Main body End Here -->
    </div>
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