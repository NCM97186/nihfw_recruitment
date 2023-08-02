<div class="contact-page-area container-fluid padding-bottom">
    <div class="container">
        <div class="col-heading">
            <div class="row">
                
                
                <div class="col-md-4">
                    <div class="col-vacancies">
                        <h3>Registration</h3>
                        <button class="btn btn-danger regis" onclick="location.href='<?php echo base_url('user/registration')?>';">Click for New Registration <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                         <form method="post" id="login-form" action="<?php echo base_url('user/getlogin')?>" enctype="multipart/form-data">
                             <?php
                                if($this->session->flashdata('message')!=''){
                                    $message    =   $this->session->flashdata('message');
                                    if($message!=''){
                                        echo '<div class="alert alert-danger"><button type="button" class="btn btn-danger" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Oh snap!</strong> '.$message.'.</div>';
                                    }
                                    $this->session->unset_userdata('message');
                                }
                                ?>
                        <div class="login_form">
                            <div class="form-group">
                                <label>Registration Number</label>
                                <input type="text" class="form-control" name="cand_mob" placeholder="Enter Registration Number" value="<?php echo set_value('cand_mob'); ?>"/>
                                <span class="form_error"><?php echo form_error('cand_mob'); ?></span>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <label class="pull-right"><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Forgot Password</a></label>
                                <input type="text" class="form-control" name="password" placeholder="Enter Password" value="<?php echo set_value('password'); ?>"/>
                                <span class="form_error"><?php echo form_error('password'); ?></span>
                            </div>
                            <?php if($this->config->item('captcha_enabled')) { ?>
                            <div class="col-capcha">
                                <div class="clearfix">
                                    <div class="capcha_part">
                                        <div class="form-group">
                                            <label>Security Code</label>
                                            <input type="text" class="form-control" name="captcha">
                                            <input type='hidden' name='code' value='<?php echo $captcha["word"];?>'>
                                            <span class="form_error"><?php echo form_error('captcha'); ?></span>
                                        </div>

                                    </div>
                                    <div class="capcha_part_right">
                                        <?php echo $captcha['image'];?>
                                    </div>
                                    <div class="capcha_part_right_1">
                                    <img style="width: 22px; margin: 35px 10px;" src="<?php echo base_url() ?>assets/img/refresh.png" />
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                            <div class="form-group">
                                <input type="submit" name="login" class="btn btn-success" value="Submit" />
                            </div>
                        </div>
                     </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var inputCaptcha = $("#captcha").val();
        var sessCaptcha = '<?php echo $this->session->userdata('captchaCode') ?>';
        //alert(inputCaptcha+"="+sessCaptcha);
       $('.refreshCaptcha').on('click', function(){
            $.get('<?php echo base_url().'captcha/refresh'; ?>', function(data){
                $('#captImg').html(data);
            });
        });
        
    
  
  $("#login-form").validate({
    rules: {
      cand_mob: {
           required:true,
           minlength:10,
           maxlength:10,
           number: true
      },
      password: "required",
      
    },
    // Specify validation error messages
    messages: {
      cand_mob: "Please enter Registration Number",
      password: "Please enter Password",
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
       

    });
</script>