
<?php
$admin_detail = get_admin_detail($_SESSION['ADMIN']['admin_id']);


?>
<!-- Start wrapper-->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <h4 class="page-title">Welcome  
                    <span style='color:#fff;'> <?php print_r($admin_detail['username']); ?></span></h4>
                <!--  <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Ministry</li>
      </ol> -->
            </div>

        </div>


            <div class="">
                <div class="card profile-card-2">
                     <div class="card-header">My Profile</div>
                    <div class="card-img-block">
                    </div>
                    <div class="card-body pt-5">
                        <img src="<?php echo base_url();?>assets/images/avatars/avatar-15.png" alt="profile-image" class="profile">
                        <!-- <h5 class="card-title"><?php echo $admin_detail['fname']; ?></h5> -->
                    </div>

                    <div class="card-body border-top border-light">
                        <div class="media align-items-center">
                          <table class="table table-bordered">
                                   
                                    <?php if ($admin_detail['role_name'] != '') { ?>
                                        <tr>    
                                            <td style="font-weight:bold;">Role:</td> <td><?php echo $admin_detail['role_name']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td style="font-weight:bold;">Full Name:</td> <td><?php echo $admin_detail['fname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Department:</td> <td><?php echo $admin_detail['department_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Designation:</td> <td><?php echo $admin_detail['designation_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Email:</td> <td><?php echo $admin_detail['email']; ?> </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Contact:</td> <td><?php echo $admin_detail['mobile']; ?></td>
                                    </tr>
 

                                </table>
                        </div>
                        <hr>
                        
                    </div>
                </div>

            </div>
            


    </div>
    <!-- End container-fluid-->

</div><!--End content-wrapper-->
<!--Start Back To Top Button-->
