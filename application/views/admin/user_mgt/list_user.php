
    <!-- Start wrapper-->
     <div class="content-wrapper">
            <div class="container-fluid">

                <?php //echo "<pre>"; print_r($_SESSION); die; ?>

                <!--Start Dashboard Content-->
                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">User Management</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/welcome'); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View User</li>
                        </ol>
                    </div>

                </div>
                <?php $this->load->view('common/messages.php'); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><i class="fa fa-table"></i> User List</div>
                            
                          <div class="card-body">
                            	<form method='GET' action="<?php echo base_url('admin/user'); ?>">
                            	<div class="row">

                                <div class="col-md-2">
                                    <?php $role_required = false; ?>
                                     <?php $this->load->view('common/role_select_box.php'); ?>
                                </div>
								
								    <div class="col-md-3">
									  <div class="form-group">
									 <label>Username</label>
									   <input type="text" class="form-control no-error" name="username" placeholder="Type here for search" 
								value="<?php if(isset($username)){print($username);}; ?>" />
									 
									 </div>
								   </div>

								
								    <div class="col-md-3">
						           <div class="form-group" style="margin-top: 30px;">
						            <button type="submit" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-search"></i>Search</button>
						          </div>
						          </div>
          
            					</div>
            				</form>

                                <div class="table-responsive">
                                    <table id="default-datatabl" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>UserName</th>
                                                <th>Full Name</th>
                                                <th>Role</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Department</th>
                                                <th>Designation</th>
                                                <th>Status</th> 
												<th>Action</th>												
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                               $i=$offset; 
                                               $p=$this->input->get('page');
                                               $t=$per_page*$p;
                                               if($p==0){
                                                $p=1;
                                                $t=$per_page*$p;
                                               }
                                               if($p==$pg){
                                                $t=$total_rows;

                                               }?>
                                               <?php echo "Showing "."<b>".($i+1)."</b> to <b>".$t."</b> out of<b> ".$total_rows."</b>"; ?> 

                                           <?php
                                            foreach ($user_list as $ulist) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i+1; ?>.</td>
                                                     <td><?php echo $ulist['username']; ?></td>
                                                    <td><?php echo $ulist['fname']; ?></td>
                                                    <td><?php echo $ulist['role_name']; ?></td>
                                                    <td><?php echo $ulist['mobile']; ?></td>
                                                    <td><?php echo $ulist['email']; ?></td>  
                                                    <td><?php echo $ulist['department_name']; ?></td>
                                                    <td><?php echo $ulist['designation_name']; ?></td>          
                                                    <?php
                                                    if ($ulist['status'] == 1) {
                                                        $status_value ='<span class="label text-success">Active</span>';
                                                    } else 
                                                    {
                                                        $status_value = '<span class="label text-danger" >In-Active</ span>';
                                                    }
                                                    ?>
                                                
                                                    <td><?php echo $status_value; ?></td>
													<td>
                                                        <button type="button" class="btn btn-primary btn-sm waves-effect waves-light m-1 viewUser" data-toggle="modal" data-target="#largesizemodal" value="<?php echo $ulist['admin_id']; ?>">View</button>
														<?php if(has_admin_permission_layout('EDIT_USER')) { ?>
                                                        <a class="btn btn-warning btn-sm waves-effect waves-light m-1 edituser" data-toggle="modal" data-target="#largesizemodal" value="<?php echo $ulist['admin_id']; ?>" 
														href="<?php echo base_url() . 'admin/user/add_edit_user/'. $ulist['admin_id'] ;?>"
														>Edit</a>
														<?php } ?>
                                                      
                                                    </td>                                              
                                                   
                                                   
                                                </tr>
												<?php $i++;
												}
											?>
                                        </tbody>
                                    </table>
                                     <div class="pagination"><?php echo $links[0]; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Row-->
            </div>
            </div>
            <!-- End container-fluid-->


        <!-- Modal -->
        <div class="modal fade" id="largesizemodal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">User Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id='model_data_ajax'></div>
				</div>
			</div>
		</div>
        <!-- Modal -->




<script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript">

    $(document).ready(function () {

  
        //$(".getUserId").click(function () {

		 $('body').on('click', '.viewUser',function(e){
		    e.preventDefault();
			console.log('user view');
            var uId = $(this).val();
            var url = "<?php echo base_url() . 'admin/user/getUserDetail/' ?>"+uId;
            $.ajax({
                type: "POST",
                url: url,
                data: {'layout_type':'popup'},
                success: function (data) {
                    $("#model_data_ajax").html(data);
                },
                 beforeSend: function () {
                    $("#model_data_ajax").html('Please wait...');
                 },
                failure: function (data) {
                    alert('Failure!');
                }
            });

        });

       $('body').on('click', '.edituser',function(e){
			e.preventDefault();
            var uId = $(this).attr('value');
            url = "<?php echo base_url() . 'admin/user/add_edit_user/' ?>"+uId;
            $.ajax({
                type: "GET",
                url: url,
                data: {'layout_type':'popup'},
                success: function (data) {
                    $("#model_data_ajax").html(data);
                },
                 beforeSend: function () {
                    $("#model_data_ajax").html('Please wait...');
                 },
                failure: function (data) {
                    alert('Failure!');
                }
            });

        });
      
    });
	
	$('body').on('submit', '#add_edit_user_form',function(e){
		    e.preventDefault();
				console.log( 'xyz' );
            var form = $('#add_edit_user_form');
		    var url = form.attr('action')+ '?layout_type=popup';
			console.log( url );
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize() ,
                success: function (data) {
                    $("#model_data_ajax").html(data);
                },
                 beforeSend: function () {
                    $("#model_data_ajax").html('Please wait...');
                 },
                failure: function (data) {
                    alert('Failure!');
                }
            });

        });
	//}
	
    /* Get District List Based On State ID code ended */

    </script>


 