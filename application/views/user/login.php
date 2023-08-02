<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);

?>
<div class="contact-page-area container-fluid padding-bottom" id="national_form_rig">
    <div class="container">
        <div class="col-heading">
            <div class="row" style="background-color:#fff; box-shadow: 0 10px 30px #888888;">


                <div class="col-md-6" style="margin:0 auto; float:none;">
                    <div class="col-vacancies">
                        <h3>Login</h3>
                        <p class="all_rig">* If already register please login</p>
                        <form method="post" id="login-form" action="<?php echo base_url('user/getUserlogin')?>" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
                            <?php
                            if ($this->session->flashdata('message') != '') {
                                $message    =   $this->session->flashdata('message');
                                if ($message != '') {
                                    echo '<div class="alert alert-danger"><button type="button" class="btn btn-danger" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Oh snap!</strong> ' . $message . '.</div>';
                                }
                                $this->session->unset_userdata('message');
                            }
                            ?>
                            <div class="login_form">
                                <div class="form-group">
                                    <label>Registration Number</label>
                                    <input type="text" class="form-control" name="cand_mob" placeholder="Enter Registration Number" value="<?php echo set_value('cand_mob'); ?>" />
                                    <span class="form_error"><?php echo form_error('cand_mob'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <label class="pull-right"><a href="<?php echo base_url(); ?>/user/forgotPassword"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Forgot Password</a></label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="<?php echo set_value('password'); ?>" />
                                    <span class="form_error"><?php echo form_error('password'); ?></span>
                                </div>
                                <?php if ($this->config->item('captcha_enabled')) { ?>
                                    <div class="col-capcha">
                                        <div class="clearfix">
                                            <div class="capcha_part">
                                                <div class="form-group">
                                                    <label>Security Code</label>
                                                    <input type="text" class="form-control" name="captcha">
                                                    <input type='hidden' name='code' value='<?php echo $captcha["word"]; ?>'>
                                                    <span class="form_error"><?php echo form_error('captcha'); ?></span>
                                                </div>

                                            </div>
                                            <div class="capcha_part_right">
                                                <?php echo $captcha['image']; ?>
                                            </div>
                                            <div class="capcha_part_right_1">
                                                <img style="width: 22px; margin: 35px 10px;" src="<?php echo base_url() ?>assets/img/refresh.png" />
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group"> 
                                    <input type="submit" name="login" id="loginform" onclick="return getPass();" class="btn btn-success" value="Submit" />
                                    <p>New User <a href="<?php echo base_url(); ?>/user/registration">click here</a></p>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>

                <div class="col-md-6" style="display:none;">
                    <?php $this->load->view('common/messages.php');  ?>
                    <div class="col-vacancies">
                        <h3>Registration</h3>
                        <form method="post" id="registration-form" action="<?php echo base_url('user/login') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />    
                        <div class="login_form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input name="first_name" type="text" class="CapLetter form-control" value="<?php echo set_value('first_name'); ?>">
                                            <span class="form_error"><?php echo form_error('first_name'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input name="middel_name" type="text" class="CapLetter form-control" value="<?php echo set_value('middel_name'); ?>">
                                            <span class="form_error"><?php echo form_error('middel_name'); ?></span>
                                        </div>
                                    </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="last_name" type="text" class="CapLetter form-control" value="<?php echo set_value('last_name'); ?>">
                                            <span class="form_error"><?php echo form_error('last_name'); ?></span>
                                        </div>
                                    </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Mobile No</label>
                                            <input name="reg_cand_mob" value="<?php echo set_value('reg_cand_mob'); ?>" type="text" maxlength="10" id="" title="Please Enter only 10 digit mobile number" class="form-control">
                                            <span class="form_error"><?php echo form_error('reg_cand_mob'); ?></span>
                                        </div>
                                    </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>E-mail ID</label>
                                            <input name="reg_cand_email" value="<?php echo set_value('reg_cand_email'); ?>" type="text" maxlength="50" id="" title="Please Type Email Id" class="form-control">
                                            <span class="form_error"><?php echo form_error('reg_cand_email'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($this->config->item('captcha_enabled')) { ?>
                                    <div class="col-capcha">
                                        <div class="clearfix">
                                            <div class="capcha_part">
                                                <div class="form-group">
                                                    <label>Security Code</label>
                                                    <input type="text" class="form-control" name="reg_captcha">
                                                    <input type='hidden' name='code' value='<?php echo $captcha["word"]; ?>'>
                                                    <span class="form_error"><?php echo form_error('reg_captcha'); ?></span>
                                                </div>

                                            </div>
                                            <div class="capcha_part_right">
                                                <?php echo $captcha['image']; ?>
                                            </div>
                                            <div class="capcha_part_right_1">
                                                <img style="width: 22px; margin: 35px 10px;" src="<?php echo base_url() ?>assets/img/refresh.png" />
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <input type="submit" name="register" value="Submit" class="btn btn-success">
                                </div>
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
            $('.refreshCaptcha').on('click', function() {
                $.get('<?php echo base_url() . 'captcha/refresh'; ?>', function(data) {
                    $('#captImg').html(data);
                });
            });



            $("#login-forms").validate({
                rules: {
                    cand_mob: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
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
/* Registration form validation */
            $("#registration-forms").validate({
                rules: {
                    cand_mob: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
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
    <script src="<?php echo base_url('assets/js/sha512.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/getpwd.js'); ?>"></script>
		
<script type="text/javascript" language="javascript">

    
    function getPass()
      {
      
      var salt = '<?php echo $_SESSION['salt']; ?>'; 
      var exp= /((?=.*\d)(?=.*[a-z])(?=.*[@#$%]).{6,10})/;
         
      var value = document.getElementById('password').value;

        
      if (value=='')
          {
              alert('Please enter username and password');
              return false;
          }
          else
          {
        
              
              if (value!='')
              {
          
         
           var hash= '';
      
           var hash = hex_sha512(value) + salt;
          document.getElementById('password').value=hash;
          document.getElementById("loginform").submit();
          return true;
              }
  
          }
      }
    
  
  </script>