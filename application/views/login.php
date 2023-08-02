 <div class="wraper">
    <div class="loader-wrapper">
		<div class="lds-ring">

		</div>
    </div>
  <div class="card card-authentication1 mx-auto my-5">
    <div class="card-body">
     <div class="card-content p-2">
      <div class="text-center">
       <a href="<?php echo base_url('/'); ?>"> <img src="<?php echo $this->config->item('assets-url-admin');?>img/logo-nihfw.jpg" alt="logo icon"></a>
      </div>
      <div class="card-title text-uppercase text-center py-3" style="color:#000 !important;">Login Page</div>
		<?php
        $action =   base_url()."login/getlogin";
        echo form_open($action);
        ?>
        <?php
        if($this->session->flashdata('message')!=''){
            $message    =   $this->session->flashdata('message');
            if($message!=''){
                echo '<div class="alert alert-danger"><button type="button" class="btn btn-danger" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Oh snap!</strong> '.$message.'.</div>';
            }
            $this->session->unset_userdata('message');
        }
        ?>
        <div class="form-group">
        <label for="exampleInputUsername" class="sr-only">Username</label>
         <div class="position-relative has-icon-right">
          <input type="text" id="username" name="username"  class="form-control input-shadow" placeholder="Enter Username" maxlength="15" required autofocus>
          <div class="form-control-position">
            <i class="icon-user"></i>
          </div>
         </div>
        </div>
        <div class="form-group">
        <label for="exampleInputPassword" class="sr-only">Password</label>
         <div class="position-relative has-icon-right">
          <input type="password" id="password" class="form-control input-shadow" placeholder="Enter Password" required name="password" maxlength="20">
          <div class="form-control-position">
            <i class="icon-lock"></i>
          </div>
         </div>
        </div>
        <p id="captImg"><?php echo $captcha;?>
        <a tabindex="-1" style="border-style: none" href="<?php echo site_url('login'); ?>" title="Refresh Image" ><img src="<?= base_url('assets/images/refresh_icon-big.png'); ?>" alt="Reload Image" border="0" 
         align="bottom" /></a>
   		</p>
   		Enter the code : 
		<input type="text" name="captcha" value="" autocomplete="off"/>
  <div class="forget_pass" style="margin-left:395px"><a href="<?php echo site_url('login/forgotpassword'); ?>">Forget Password</a></div>
		<div class="form-row">
			<div class="form-group col-6">
			 <div class="icheck-material-primary">
					<input type="checkbox" name='remember_me' id="user-checkbox" <?php if(isset($remember_me)){echo "checked";} ?>>
					<label for="user-checkbox">Remember me</label>
			 </div>
			</div>

		</div>
      
    <input type="submit" class="btn btn-danger" id="loginform" onclick="return getPass();" value="Log In">
	<?php echo form_close();?>
     </div>
    </div>
     
  </div>
</div>  
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>


<!-- captcha refresh code -->
<script>
jQuery(document).ready(function(){
    jQuery('.refreshCaptcha').on('click', function(){
        jQuery.get('<?php echo base_url().'login/refresh_captcha'; ?>', function(data){
            $('#captImg').html(data);
        });
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
		
</div>