
					<div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-1">Username </label>
                                     <?php echo $username; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                                <div class="form-group">
                                <label for="input-2">Mobile Number </label>
                                <?php echo $mobile ?>
                                </div>
                            </div>                                      
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="input-3">Full Name</label>
                                   <?php echo $fname; ?>
                                </div>
                            </div>
                        </div>
                        <h5>User Role</h5>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="input-1">Choose Role</label>
                                    <?php echo $role_name;?>
                                </div>
                            </div>
                      
                           
                        </div>

                        <h5>User Active</h5>
                        <hr/>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Email Id</label>
                                   <?php echo $email;?>
                                </div>
                            </div>
                             <div class="col-lg-6">
                                 <div class="form-group" style="padding: 37px 0px 0px;">
                                    <?php
                                        if ($user_status == 1) {
                                            echo $status_value ='<span class="label text-success">Active</span>';
                                        } else 
                                        {
                                            echo $status_value = '<span class="label text-danger" >In-Active</ span>';
                                        }
                                        ?>
                                </div>
                            </div>

                        </div>
						<?php if(has_admin_permission_layout('EDIT_USER')) { ?>
						<div class="row">
                            <div class="col-lg-6">
						   <button type="button" class="btn btn-warning btn-sm waves-effect waves-light m-1 edituser" value="<?php echo $admin_id;?>" >Edit</button>
						   </div>
						</div>
						<?php } ?>
						