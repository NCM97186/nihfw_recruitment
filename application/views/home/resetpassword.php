<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);

?>
<div class="contact-page-area padding-bottom">
    <div class="container-fluid">
        <div id="national_form" style="text-align: center">
        <?php $this->load->view('common/messages.php'); ?>
            <?php
            //echo $this->session->set_userdata('otp_verified_status', 0);
            //echo $this->session->userdata('otp_verified_status');
            if($this->session->userdata('otp_verified_status') == 1){?>
              <form method="post" action="<?php echo site_url('Resetpass/updatepassword') ?>">
              <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
            <div class="text-center">
              <div class="form-group row">
                  <label class="col-md-3">Enter New password <font color="red">*</font></label>

                      <div class="col-md-3">
                        <input type="password" name="new_pass"
                          data-date-inline-picker="true" placeholder="New Password" class="form-control error">
                        <span class="form_error"><?php echo form_error('OTP not entered'); ?></span>
                      </div>
                      
              </div>
              <div class="form-group row">
                  <label class="col-md-3">Confirm password <font color="red">*</font></label>

                      <div class="col-md-3">
                        <input type="password" name="confirm_pass"
                          data-date-inline-picker="true" placeholder="Confirm Password" class="form-control error">
                        <span class="form_error"><?php echo form_error('OTP not entered'); ?></span>
                      </div>
                      
              </div>
            </div>
            <div class="text-center">
                <button type="submit" id="" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i>Update Password</button>
               
                <!-- <button type="button" class="btn btn-warning px-5" data-dismiss="modal"><i aria-hidden="true" class="fa fa-paper-plane"></i>Close</button> -->
            </div>
          </form>
            <?php }else{

            
            ?>
            <form method="post" action="<?php echo site_url('Resetpass/verify_otp') ?>">
            <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
            <div class="text-center">
              <div class="form-group row">
                  <label class="col-md-3">Enter OTP <font color="red">*</font></label>

                      <div class="col-md-3">
                        <input type="text" name="otp_text"
                          data-date-inline-picker="true" placeholder="Enter OTP" onkeypress="return validateNumber(event);" class="form-control error" maxlength="5">
                        <span class="form_error"><?php echo form_error('OTP not entered'); ?></span>
                      </div>
                      <div class="col-md-3">
                        <a  href="<?php echo site_url('ResetPass/ResendsendOTP') ?>" class=" btn btn-warning px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i>Resend OTP</a>
                     </div>
              </div>
            </div>
            <div class="text-center">
                <button type="submit" id="" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i>Verify</button>
                <a  href="<?php echo site_url() ?>" type="reset" id="" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
                <!-- <button type="button" class="btn btn-warning px-5" data-dismiss="modal"><i aria-hidden="true" class="fa fa-paper-plane"></i>Close</button> -->
            </div>
          </form>
          <?php } ?>
        </div>
        <!-- Main body End Here -->
    </div>
</div>

<script>
    function validateNumber(e) {
            const pattern = /^[0-9]$/;

            return pattern.test(e.key )
        }
</script>
