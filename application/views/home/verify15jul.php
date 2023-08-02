
<div class="contact-page-area padding-bottom">
    <div class="container-fluid">
        <div id="national_form" style="text-align: center">
            <div class="panel panel-info national_form_border">
                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%">
<?php $this->load->view('common/messages.php'); ?>
                    </div>
                </div>
            </div>
            <form method="post" action="<?php echo site_url('Verify/verify_otp') ?>">
            <div class="text-center">
              <div class="form-group row">
                  <label class="col-md-3">Enter OTP <font color="red">*</font></label>

                      <div class="col-md-3">
                      <input type="text" name="otp_text" 
                        data-date-inline-picker="true" placeholder="Enter OTP" class="form-control error">
                      <span class="form_error"><?php echo form_error('OTP not entered'); ?></span>
                  </div>
              </div>
            </div>
            <div class="text-center">
                <button type="submit" id="" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i>Verify</button>
                <a  href="<?php echo site_url() ?>" type="reset" id="" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
                <!-- <button type="button" class="btn btn-warning px-5" data-dismiss="modal"><i aria-hidden="true" class="fa fa-paper-plane"></i>Close</button> -->
            </div>
          </form>
        </div>
        <!-- Main body End Here -->
    </div>
</div>

<script>
    $(document).ready(function() {

    });
</script>
