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
                                        <th>Address</th>
                                        <th>Mobile Number</th>
                                        <th>Mobile no Verified</th>
                                        <th>E-mail Address</th>
                                        <th>Landline</th>
                                        <th>Address for correspondence</th>
                                        <th>PIN Code</th>
                                        <th>Date Of Birth</th>
                                        <th>Category</th>
                                        <th>Brief Discription of service</th>
                                        <th>Experience in Health Sector</th>

                                    </tr>
                                <tbody>
                                  <?php $i=1;
                                  foreach($results as $result) {
                                      if($result->cand_cat==1){
                                        $category = 'SC';
                                      }else if($result->cand_cat==2){
                                        $category = 'ST';
                                      }else if($result->cand_cat==3){
                                        $category = 'OBC';
                                      }else{
                                        $category = 'General';
                                      }
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td>
                                          <!-- <div class="form-group row"> -->
                                  <!-- <label class="col-md-6">Candidate Profile Status  <font color="red">*</font></label> -->
                                  <!-- <div class="col-md-12"> -->
                                  <input type="hidden" id="cand_id_<?php echo $i; ?>" value="<?php echo $result->cand_id; ?>" />
                                  <select name="status_id[]" id="cos_id_<?php echo $i; ?>" class="form-control error" required="1" onChange="storedata(<?php echo $i; ?>)">
                                      <?php $prestatus_id =   isset($result) ? set_value("status_id", $result ->status_id) : set_value("status_id");
                                      $cos=get_cand_profile_status_list();
                                      foreach($cos as $key_cos =>$value_cos) {
                                          ?>
                                          <option value="<?php echo $key_cos;?>"
                                          <?php if($prestatus_id  == $key_cos) { echo 'selected'; }  ?>
                                          ><?php echo $value_cos;?></option>
                                          <?php
                                      }
                                      ?>
                                  </select>
                                  <br>
                                  <?php //if(isset($result ->status_id)){echo $result ->status_id;}  ?>
                                  <span class="form_error"><?php echo form_error('status_id'); ?></span>
                              <!-- </div>
                          </div> -->

                                        </td>
                                        <td>
                                          <div style="display: flex;">
                                          <a href="<?php echo base_url('admin/participants/view/'.$result->cand_id); ?>" class="btn btn-warning btn-sm editImage" >View Candidate</a>
                                          &nbsp;&nbsp;
                                            <!--<a href="" class="btn btn-primary btn-sm editImage"><i class="fa fa-pencil"></i></a>
                                            &nbsp;&nbsp;-->
                                            <a href="" class="btn btn-danger btn-sm deleteImage" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </td>
                                        <td><?php echo $result->cand_name; ?></td>
                                        <td><?php echo $result->adver_title; ?></td>
                                        <td><?php echo $result->post_name; ?></td>
                                        <td><?php echo $result->cand_addr; ?></td>
                                        <td><?php echo $result->cand_mob; ?></td>
                                        <td><?php if($result->regis_otp==0){?>
                                                      <font color="red">Not Verified</font><?php }
                                                else{?>
                                                    <span style='font-size:50px;'>&#9989;</span>
                                                    <!-- <i class="fa fa-check fa-3x" aria-hidden="true"></i> -->
                                                <?php } ?></td>
                                        <td><?php echo $result->cand_email; ?></td>
                                        <td><?php echo $result->cand_landline; ?></td>
                                        <td><?php echo $result->cand_addr_corr; ?></td>
                                        <td><?php echo $result->cand_pincode; ?></td>
                                        <td><?php echo $result->cand_dob; ?></td>
                                        <td><?php echo $category; ?></td>
                                        <td><?php echo $result->cand_brief_service_perticular; ?></td>
                                        <td><?php echo $result->cand_exp_in_health_sec; ?></td>

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
