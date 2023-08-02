<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('common/messages.php'); ?>

        <div class="row ">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> <?php echo (isset($ddata)?'Edit':'Add'); ?> Department</div>
                    <div class="card-body">

                        <form method="post" action="<?php echo site_url('admin/Dashboard/changePasswordProcess/'); ?>">
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
                                        <a  href="<?php echo site_url('/admin/Dashboard') ?>" type="reset" id="srch" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
                                    </div>

                            </div>
                        </form>
                    </div>
                </div>
            
                </div>
            </div>
        </div><!-- End Row-->


    </div>
    <!-- End container-fluid-->
</div>
<script src="<?php echo base_url('assets/js/sha512.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/getpwd.js'); ?>"></script>
 <script type="text/javascript" language="javascript">
    
    function getPass()
      {
      
      var salt = '<?php echo $_SESSION['salt']; ?>'; 
      var exp= /((?=.*\d)(?=.*[a-z])(?=.*[@#$%]).{6,10})/;
         
      var value = document.getElementById('old_password').value;
      var value1 = document.getElementById('new_password').value;
	  var value2 = document.getElementById('confirm_password').value;
      if (value=='')
          {
              alert('Please enter old password');
              return false;
          }
      if (value1=='')
          {
              alert('Please enter new password');
              return false;
          }
        
          if (value2=='')
          {
              alert('Please enter confirm password');
              return false;
          }
     
          else
          {
        
              
              if (value!='')
              {
          
         
           var hash= '';
      
           var hash = hex_sha512(value);
		   var hash1 = hex_sha512(value1);
           var hash2 = hex_sha512(value2);
        
          document.getElementById('old_password').value=hash;
		  document.getElementById('new_password').value=hash1;
          document.getElementById('confirm_password').value=hash2;
          document.getElementById("changeform").submit();
          return true;
              }
  
          }
      }
    
  
  </script>