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
                       <form method="GET" action="">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Advertisement</label>
                                        <select name="advertisement_ID" class="form-control error" style="font-size: 0.8rem;" required="1">
                                        <option value="0" selected="selected">Advertisement</option>
                                        <?php
                                        if(isset($advertisement)){
                                            foreach($advertisement as $ad){?>
                                                <option value="<?php echo $ad->adver_id; ?>" <?php if(isset($_REQUEST['advertisement_ID']) && $_REQUEST['advertisement_ID']  == $ad->adver_id){ echo 'selected'; } ?>><?php echo $ad->adver_title; ?></option>
                                            <?php }
                                        }
                                        ?>
                                        
                                        </select>

                                        <span class="form_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2" >
                                    <div class="form-group">
                                        <label>Post</label>
                                        <select name="Post_ID" class="form-control error" style="font-size: 0.8rem;" required="1">
                                            <option value="0" selected="selected">Select Post</option>
                                            <?php
                                            if(isset($jobpost)){
                                                foreach($jobpost as $post){?>
                                                    <option value="<?php echo $post->post_id; ?>" <?php if(isset($_REQUEST['Post_ID']) && $_REQUEST['Post_ID']  == $post->post_id){ echo 'selected'; } ?>><?php echo $post->post_name; ?></option>
                                                <?php }
                                            }
                                            ?>
                                            
                                        </select>
                                        <span class="form_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="Category_ID" class="form-control error" style="font-size: 0.8rem;" required="1">
                                            <option value="0" selected="selected">Category</option>
                                            <?php
                                            if(isset($category)){
                                                foreach($category as $cat){?>
                                                    <option value="<?php echo $cat->id; ?>" <?php if(isset($_REQUEST['Category_ID']) && $_REQUEST['Category_ID'] == $cat->id){ echo 'selected'; } ?>><?php echo $cat->category; ?></option>
                                                <?php }
                                            }
                                            ?>
                                        </select>
                                        <span class="form_error"></span>
                                    </div>
                                </div>
                                <!-- <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <font color="red">*</font>
                                        <select name="Gender_ID" class="form-control error" style="font-size: 0.8rem;" required="1">
                                            <option value="0" selected="selected">Gender</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Other</option>
                                        </select>
                                        <span class="form_error"></span>
                                    </div>
                                </div> -->
                                <div class="col-md-2" >
                                    <div class="form-group">
                                        <label>Status Filter</label>                                       
                                        <select name="StatusFilter_ID" class="form-control error" style="font-size: 0.8rem;" required="1">
                                            <option value="0" selected="selected">Status Filter</option>
                                            <?php
                                            
                                            if(isset($candprofilestatus)){
                                                foreach($candprofilestatus as $status){?>
                                                    <option value="<?php echo $status->status_id; ?>" <?php if(isset($_REQUEST['StatusFilter_ID']) && $_REQUEST['StatusFilter_ID']  == $status->status_name){ echo 'selected'; } ?>><?php echo $status->status_name; ?></option>
                                                <?php }
                                            }
                                        ?>
                                             
                                            
                                        </select>
                                        <span class="form_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2" >
                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="date" name="adver_datef" 
                                          data-date-inline-picker="true" placeholder="Advertisement Date" class="form-control error" style="font-size: 0.8rem;">
                                        <span class="form_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2" >
                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" name="adver_datet" 
                                          data-date-inline-picker="true" placeholder="Advertisement Date" class="form-control error" style="font-size: 0.8rem;">
                                        <span class="form_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" id="srch" class="btn btn-primary px-4 m-t-30"><i aria-hidden="true" class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                        <div> <button   id="exportexcel" target="_blank" class="btn btn-info" style="float:right;">Export</button></div>
                        
                    <div class="card-body">
                        <div class="table-responsive table-basic1" style="overflow-x:auto;">
                            <table id="default-datatable1" class="table table-bordered1">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                     
                                         <th>Name of the applicant</th>
                                        <th>Advertisement Title</th>
                                        <th>Post Name</th>
                                        <th>Mobile</th>
                                        <th>E-mail Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
                                      
                                       
                                        <td><?php echo $result->first_name." ".$result->middel_name." ".$result->last_name; ?></td>
                                        <td><?php echo $result->adver_title; ?></td>
                                        <td><?php echo $result->post_name; ?></td>
                                        <td><?php echo $result->cand_mob; ?></td>
                                        <td><?php echo $result->cand_email; ?></td>
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
                                      <?php echo $varify_status;?>
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
<script>
   
jQuery(document).ready(function(){
    jQuery('#exportexcel').click(function() {
        var advertisement_ID="<?php echo !empty($_GET['advertisement_ID'])?$_GET['advertisement_ID']:''; ?>";
        var Post_ID="<?php echo !empty($_GET['Post_ID'])?$_GET['Post_ID']:''; ?>";
        var Category_ID="<?php echo !empty($_GET['Category_ID'])?$_GET['Category_ID']:''; ?>";
        var StatusFilter_ID="<?php echo !empty($_GET['StatusFilter_ID'])?$_GET['StatusFilter_ID']:''; ?>";
        var adver_datef="<?php echo !empty($_GET['Post_ID'])?$_GET['adver_datef']:''; ?>";
        var adver_datet="<?php echo !empty($_GET['Post_ID'])?$_GET['adver_datet']:''; ?>";
        var url1='<?=base_url()?>/admin/Participants/exportcsv';
    jQuery.ajax({
            url:'<?=base_url()?>/admin/Participants/exportcsv',
            method: 'post',
            data: {advertisement_ID: advertisement_ID, Post_ID: Post_ID, Category_ID: Category_ID, StatusFilter_ID: StatusFilter_ID, adver_datef: adver_datef, adver_datet: adver_datet},
            success: function(data){
                var downloadLink = document.createElement("a");
                var fileData = ['\ufeff'+data];

                var blobObject = new Blob(fileData,{
                type: "text/csv;charset=utf-8;"
                });

                var url = URL.createObjectURL(blobObject);
                downloadLink.href = url;
                downloadLink.download = "participants.csv";

                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);

            }
        });
    });
});
</script>