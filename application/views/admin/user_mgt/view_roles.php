        <div class="content-wrapper">
            <div class="container-fluid">

                <!--Start Dashboard Content-->
                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">Roles</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/user/roles'); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View Roles</li>
                        </ol>
                    </div>
                </div>
				<?php $this->load->view('common/messages.php'); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><i class="fa fa-table"></i> Role List</div>
                            
                          <div class="card-body">                            	

                                <div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>User Roles</th>
                                                <th>Description</th>                                         
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                           
                                            foreach ($roles as $role) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $role['role_id']; ?></td>              
                                                    <td><?php echo $role['role_name']; ?></td>
                                                    <td><?php echo $role['role_desc']; ?></td>
                                                  <td>
                                                     <a href='<?php echo base_url('admin/user/roles_permission/'.$role['role_id']);?>'>View</a>       
                                                    </td>
                                                </tr>
                                             <?php   }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Row-->
            
            <!-- End container-fluid-->

        </div><!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

      
        <!-- Edit Model Ended -->

    </div><!--End wrapper-->
