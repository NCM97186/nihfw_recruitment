<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <!--<h4 class="page-title">Daily Reporting</h4>-->
                <h4 class="page-title"></h4>

            </div>
        </div>
        <!-- End Breadcrumb-->


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Participants List</div>
                    <div class="card-body">


                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive table-basic" style="overflow-x:auto;">
                            <table id="default-datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Verify</th>
                                        <th>Action</th>
                                        <th>Name of the applicant</th>
                                        <th>Advertisement Title</th>
                                        <th>Post Name</th>
                                        <th>Mobile</th>
                                        <th>E-mail Address</th>
                                    </tr>
                                <tbody>
                                  <?php $i=1;
                                  foreach($results as $result) {
                                     /* if($result->cand_cat==1){
                                        $category = 'SC';
                                      }else if($result->cand_cat==2){
                                        $category = 'ST';
                                      }else if($result->cand_cat==3){
                                        $category = 'OBC';
                                      }else{
                                        $category = 'General';
                                      }*/
                                    ?> 
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td>
										<?php 
										$varify_status = "Pending";
										$prestatus_id =   isset($result) ? set_value("status_id", @$result ->status_id) : set_value("status_id");
                                      $cos=get_cand_profile_status_list();
                                      foreach($cos as $key_cos =>$value_cos) {
										  if($prestatus_id  == $key_cos) { 
											$varify_status= $value_cos;
										  } 
                                      }
                                      ?>
								  <a href="<?php echo base_url('admin/participants/participantstatus/'.$result->application_id); ?>" class="btn btn-info <?php if($varify_status=='Pending'){?>btn-warning<?php }else{?>btn-warning<?php }?>"> 
									<?php echo $varify_status;?></a>
                                        </td>
                                        <td>
                                          <div style="display: flex;">
                                          <a href="<?php echo base_url('admin/participants/viewlist/'.$result->application_id.'_'.$result->user_id); ?>" class="btn btn-warning btn-sm editImage" style="background-color:brown">View Candidate</a>
                                          &nbsp;&nbsp;
                                            <!-- <a href="<?php //echo base_url('admin/participants/editlist/'.$result->user_id); ?>" class="btn btn-primary btn-sm editImage"><i class="fa fa-pencil"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="<?php //echo base_url('admin/participants/delete_participant/'.$result->user_id);?>" class="btn btn-danger btn-sm deleteImage" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"></i></a> -->
                                            </div>
                                        </td>
                                        <td><?php echo $result->first_name." ".$result->middel_name." ".$result->last_name; ?></td>
                                        <td><?php echo $result->adver_title; ?></td>
                                        <td><?php echo $result->post_name; ?></td>
                                        <td><?php echo $result->cand_mob; ?></td>
                                        <td><?php echo $result->cand_email; ?></td>

                                    </tr>
                                  <?php $i++; }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Row-->


    </div>
    <!-- End container-fluid-->



</div>
