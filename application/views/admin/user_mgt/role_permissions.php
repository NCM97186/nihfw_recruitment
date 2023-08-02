<?php //$this->load->view('common/include'); ?>

        <div class="content-wrapper">
            <div class="container-fluid">

                <!--Start Dashboard Content-->

                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">Role Permissions</h4>

                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/welcome'; ?>">Home</a></li>  
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo base_url() . 'admin/user/roles'; ?>">Roles</a></li>
                             <li class="breadcrumb-item active" aria-current="page">role Permissions</li>
                        </ol>
                    </div>

                </div>
                <!-- End Breadcrumb-->
			 <?php $this->load->view('common/messages.php'); ?>

                <form action="<?php echo base_url('admin/user/roles_permission_save'); ?>" method="POST" >
                    <input type="hidden" name="role_id" value="<?php echo $role_id;?>">
				
                    <div class="row">
                        <div class="col-lg">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">Update Role Permission::
                                       <span ='rolen'  style='color:red;'>
                                        <?php echo $role_detail['role_name']; ?></span>
                                       <span ='roled'> 
                                        ( <?php echo $role_detail['role_desc']; ?></span>)

                                    </div>
                                    <div>
                                        <label><input type='checkbox' name='check_all_permission' id='check_all_permission' value='1' > Check All </abel>
                                    </div>
                                    <hr>
                                    <div class="row">
                                     <?php
                                    
                                        foreach ($roles_permission as $roleP) {
                                                ?>
                                         <div class="col-lg-4">
                                             <div class="form-group" >
                                                <label style="text-transform:none;">
                                                    <input type="checkbox" class='permission_ids' 
                                                  name="permission_id[]" value="<?php echo $roleP['permission_id'];?>"
                                              <?php  if($roleP['permission_id'] == $roleP['permission_selected']) { echo 'checked';} ?>
                                                >
                                                 <b><?php echo $roleP['permission_name'];?></b><br>
                                                (<?php echo $roleP['permission_description'];?>) 
                                            </label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <hr>    
                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-primary px-5" value="submit"><i class="icon-lock"></i> Submit</button>
                                        <span id="error_message" class="text-danger"></span>  
                                        <span id="success_message" class="text-success"></span>                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--End Row-->
                </form>
                <!--End Dashboard Content-->

            </div>
            <!-- End container-fluid-->

        </div><!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

       
    <!-- Get CHC DROPDOWN VALUE BAsed On District Ended -->

<script type="text/javascript">
    
  $(function() {
     
       $("#check_all_permission").change(function(){  //"select all" change 
            var status = this.checked; // "select all" checked status
            $('.permission_ids').each(function(){ //iterate all listed checkbox items
                this.checked = status; //change ".checkbox" checked status
            });
        });

        $('.permission_ids').change(function(){ //".checkbox" change 
            //uncheck "select all", if one of the listed checkbox item is unchecked
            if(this.checked == false){ //if this item is unchecked
                $("#check_all_permission")[0].checked = false; //change "select all" checked status to false
            }
            
            //check "select all" if all checkbox items are checked
            if ($('.permission_ids:checked').length == $('.permission_ids').length ){ 
                $("#check_all_permission")[0].checked = true; //change "select all" checked status to true
            }
        });
        $('.permission_ids').trigger("change");

    
});
</script>