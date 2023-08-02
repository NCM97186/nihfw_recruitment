<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
?>
<?php if ($layout_type != 'popup') { ?>
 	<div class="content-wrapper">
 		<div class="container-fluid">

 			<!--Start Dashboard Content-->

 			<!-- Breadcrumb-->
 			<div class="row pt-2 pb-2">
 				<div class="col-sm-9">
 					<h4 class="page-title">User Management</h4>

 				</div>

 			</div>
 			<!-- End Breadcrumb-->
 		<?php } ?>
 		<?php $this->load->view('common/messages.php'); ?>
 		<!-- End Breadcrumb-->
 		<form action="<?php echo $form_url; ?>" method="POST" id='add_edit_user_form'>
		 <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
 			<input type='hidden' name='admin_id' value='<?php echo $admin_id; ?>'>
 			<div class="row">
 				<div class="col-lg">
 					<div class="card">
 						<div class="card-body">
 							<div class="card-title"><?php echo $form_title; ?></div>
 							<hr>
 							<div class="row">
 								<div class="col-lg-6">
 									<div class="form-group">
 										<label for="input-1">Username </label>
 										<input name="username" type="text" class="form-control" id="username" placeholder="Enter User Name" maxlength="15" value="<?php if (isset($username)) { print($username); }; ?>">
 										<span class="form_error"><?php echo form_error('username'); ?></span>
 									</div>
 								</div>
 								<div class="col-lg-6">

 									<div class="form-group">
 										<label for="input-2">Mobile </label>
 										<input name="mobile" type="number" class="form-control" id="mobile" placeholder="Enter Mobile Number" maxlength="15" value="<?php if (isset($mobile)) { print($mobile);	}; ?>">
 										<span class="form_error"><?php echo form_error('mobile'); ?></span>
 									</div>
 								</div>
 								<div class="col-lg-6">
 									<div class="form-group">
 										<label for="input-3">Password</label>
 										<input type="password" id="password" class="form-control no-error" name="password" placeholder="Enter User Password" maxlength="15" value="">
 										<span class="form_error"><?php echo form_error('password'); ?></span>
 									</div>
 								</div>
 								<div class="col-lg-6">
 									<div class="form-group">
 										<label for="input-3">Confirm Password</label>
 										<input type="password" id="cpassword" class="form-control no-error" name="cpassword" placeholder="Enter Confirm Password" maxlength="15" value="">
 										<span class="form_error"><?php echo form_error('cpassword'); ?></span>
 									</div>
 								</div>
 								<div class="col-lg-6">
 									<div class="form-group">
 										<label for="input-3">Full Name</label>
 										<input type="text" onkeypress="return onlyAlphabets(event,this);" class="form-control no-error" name="fname" placeholder="Enter Full Name" maxlength="15" value="<?php if (isset($fname)) { print($fname);}; ?>">
 										<span class="form_error"><?php echo form_error('fname'); ?></span>
 									</div>
 								</div>
 								<div class="col-lg-6">
 									<div class="form-group">
 										<label for="input-1">Department</label>
 										<select class="form-control error" id="department_id" name="department_id" data-uid="undefined-field-5">
 											<option value="">Choose Department</option>
													<?php foreach ($departments as $departmentVal) { ?>

														<option value="<?php echo $departmentVal->department_id; ?>" <?php if (isset($department_id) && $departmentVal->department_id == $department_id) {
														echo 'selected';
														} ?>>
														<?php echo $departmentVal->department_name; ?></option>

													<?php } ?>
 										</select>
 										<span class="form_error"><?php echo form_error('department_id'); ?></span>

 									</div>
								 </div>
								 <div class="col-lg-6">
 									<div class="form-group">
 										<label for="input-1">Designation</label>
 										<select class="form-control error" id="department_id" name="designation_id" data-uid="undefined-field-5">
 											<option value="">Choose Designation</option>
													<?php foreach ($designations as $designationVal) { ?>
													
														<option value="<?php echo $designationVal->designation_id; ?>" <?php if (isset($designation_id) && $designationVal->designation_id == $designation_id) {
														echo 'selected';
														} ?>><?php echo $designationVal->designation_name; ?></option>

													<?php } ?>
 										</select>
 										<span class="form_error"><?php echo form_error('department_id'); ?></span>

 									</div>
 								</div>
 							</div>
 							<h5>User Role</h5>
 							<hr />
 							<div class="row">
 								<div class="col-lg-12">
 									<div class="form-group">
 										<label for="input-1">Choose Role</label>
 										<select class="form-control error" id="role" name="role_id" data-uid="undefined-field-5">
 											<option value="">Choose Role</option>

 											<?php foreach ($roles as $roleVal) { ?>

 												<option value="<?php echo $roleVal['role_id']; ?>" <?php if (isset($role_id) && $roleVal['role_id'] == $role_id) {
																										echo 'selected';
																									} ?>>
 													<?php echo $roleVal['role_name']; ?></option>

 											<?php } ?>
 										</select>
 										<span class="form_error"><?php echo form_error('role_id'); ?></span>

 									</div>
 								</div>
 							</div>

 							<h5>User Active</h5>
 							<hr />

 							<div class="row">
 								<div class="col-lg-6">
 									<div class="form-group">
 										<label for="input-3">Email Id</label>
 										<input type="email" class="form-control no-error" name="email" placeholder="Enter Email Id" value="<?php if (isset($email)) {	print($email);	}; ?>">
								<span class=" form_error"><?php echo form_error('email'); ?></span>
 									</div>
 								</div>
 								<div class="col-lg-6">
 									<div class="form-group" style="padding: 37px 0px 0px;">
 										<input type="checkbox" name="status" value="1" <?php if (isset($status) && $status == 1) {
																							echo 'checked';
																						} ?>> Active?
 									</div>
 								</div>

 							</div>
 						</div>

 						<div class="card-body">
 							<hr>
 							<div class="form-group">
 								<button type="submit" name="Submit" id="editform" onclick="return getPass();" class="btn btn-primary px-5" value="Submit"><i class="icon-lock"></i> Submit</button>
 								<span id="error_message" class="text-danger"></span>
 								<span id="success_message" class="text-success"></span>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 			<!--End Row-->
 		</form>
 		<?php if ($layout_type != 'popup') { ?>
 			<!--End Dashboard Content-->

 		</div>
 		<!-- End container-fluid-->

 	</div>
 	<!--End content-wrapper-->
 	<!--Start Back To Top Button-->
 	<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
 	<!--End Back To Top Button-->
 <?php } ?>
 <script src="<?php echo base_url('assets/js/sha512.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/getpwd.js'); ?>"></script>
 <script type="text/javascript" language="javascript">
    
    function getPass()
      {
      
      var salt = '<?php echo $_SESSION['salt']; ?>'; 
      var exp= /((?=.*\d)(?=.*[a-z])(?=.*[@#$%]).{6,10})/;
         
      var value = document.getElementById('password').value;
	  var value1 = document.getElementById('cpassword').value;
  
        
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
      
           var hash = hex_sha512(value);
		   var hash1 = hex_sha512(value1);
          document.getElementById('password').value=hash;
		  document.getElementById('cpassword').value=hash1;
          document.getElementById("editform").submit();
          return true;
              }
  
          }
      }
    
  
  </script>
   <script language="Javascript" type="text/javascript">

function onlyAlphabets(e, t) {
	try {
		if (window.event) {
			var charCode = window.event.keyCode;
		}
		else if (e) {
			var charCode = e.which;
		}
		else { return true; }
		if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 32)
			return true;
		else
			return false;
	}
	catch (err) {
		alert(err.Description);
	}
}
</script>