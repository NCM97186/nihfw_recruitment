<div class="wraper">
    <div class="loader-wrapper">
		<div class="lds-ring">

		</div>
    </div>
   
  <div class="card card-authentication1 mx-auto my-5">
    <div class="card-body">
     <div class="card-content p-2">
      <div class="text-center">
      <a href="<?php echo base_url('/'); ?>"><img src="<?php echo $this->config->item('assets-url-admin');?>img/logo-nihfw.jpg" alt="logo icon"></a>
      </div>
      <div class="card-title text-uppercase text-center py-3" style="color:#000;">Forgot Password</div>
		<?php
        $action =   base_url()."login/reset_password";
        echo form_open($action);
        ?>
         <?php $this->load->view('common/messages.php'); ?>
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
        <label for="exampleInputUsername" class="sr-only">Email</label>
         <div class="position-relative has-icon-right">
          <input type="email" id="email" name="user_email"  class="form-control input-shadow" placeholder="Enter Email" required autofocus>
          <div class="form-control-position">
            <i class="icon-user"></i>
          </div>
         </div>
        </div>       
        <input type='hidden' name='code' value='<?php echo $captcha["word"];?>'>
        <p><span id="captImg"><?php echo $captcha['image'];?></span>
        <img id="refreshCaptcha" style="float:left; height: 23px; margin: 5px 11px" src="<?php echo base_url() ?>assets/img/refresh.png" />
          </p>
     Enter the code : 
		<input type="text" name="captcha" value="" autocomplete="off"/><br>
<!-- <?php //if($this->config->item('captcha_enabled')) { ?>
        <p id="captImg"><?php //echo $captcha['image'];?></p>
		<p>Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p>
		Enter the code : 
		<input type="text" name="captcha" value="" autocomplete="off"/>
  <?php //} ?> -->
 
      
		<input type="submit" class="btn btn-danger" value="submit">
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
    jQuery('#refreshCaptcha').on('click', function(){
        jQuery.get('<?php echo base_url().'Login/refresh_captcha'; ?>', function(data){
            $('#captImg').html(data);
        });
    });
});
</script>
</div>