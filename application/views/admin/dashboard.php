\<div class="content-wrapper">
    <div class="container-fluid">

        <!--Start Dashboard Content-->
        <div class="row mt-3">
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-scooter">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body border-white-2">
                            <!-- <h4 class="mb-0 text-white">203</h4> -->
                                <h4 class="mb-0 text-white"><?php echo $total_applicant; ?></h4>
                                <p class="mb-0 small-font text-white">Total Applications</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-quepal">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body border-white-2">
                                <h4 class="mb-0 text-white"><?php echo $fee_paid; ?></h4>
                                <p class="mb-0 small-font text-white">Fees Received</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-branding">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body border-white-2">
                                <h4 class="mb-0 text-white"><?php echo $shortlisted; ?></h4>
                                <p class="mb-0 small-font text-white">Approved Applications</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-blooker">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body  border-white-2">
                                <h4 class="mb-0 text-white"><?php echo $rejected; ?></h4>
                                <p class="mb-0 small-font text-white">Rejected Applications</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-bloody">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body border-white-2">
                            <h4 class="mb-0 text-white"><?php echo $pending; ?></h4>
                                <!-- <h4 class="mb-0 text-white"><?php //echo $total_applicant; ?></h4> -->
                                <p class="mb-0 small-font text-white">Pending applications</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card gradient-bloody">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body border-white-2">
                            <h4 class="mb-0 text-white"><?php echo $draft; ?></h4>
                                <!-- <h4 class="mb-0 text-white"><?php //echo $total_applicant; ?></h4> -->
                                <p class="mb-0 small-font text-white">Draft applications</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            
          

            

        </div>
        <!--Start Dashboard Content-->

      

        <!--Start Filter-->
        <div class="row">
            <div class="col-lg-12">
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
                        <div class="table-responsive">
                            <table id="default-datatabl" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name Of The Applicant</th>
                                        <th>Advertisement title</th>
                                        <th>POST</th>
                                        <th>CATEGORY</th>
                                        <th>GENDER</th>
                                        <th>STATUS FILTER</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($applicant_list)){
                                        $i=1;
                                        foreach($applicant_list as $applicants){
                                            $catid = $applicants->category_name;
                                            if($catid != 0){
                                                $this->db->where('id', $catid);
                                                // here we select every column of the table
                                                $q = $this->db->get('category')->row();
                                            }
                                            $statusid = $applicants->status_id;
                                            if($statusid != 0){
                                                $this->db->where('status_id', $statusid);
                                                // here we select every column of the table
                                                $qs = $this->db->get('cand_profile_status_master')->row();
                                            }
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $applicants->name; ?></td>
                                                <td><?php echo $applicants->adver_title; ?></td>
                                                <td><?php echo $applicants->post_name; ?></td>
                                                <td><?php echo $applicants->category_name; ?></td>
                                                <td><?php echo $applicants->gender; ?></td>
                                                <td><?php echo !empty($qs->status_name)?$qs->status_name:0; ?></td>
                                            </tr>
                                       <?php
                                        $i++;   
                                    }
                                    }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--End Filter-->
    </div>
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
        var url1='<?=base_url()?>/admin/dashboard/exportcsv';
    jQuery.ajax({
            url:'<?=base_url()?>/admin/dashboard/exportcsv',
            method: 'post',
            data: {advertisement_ID: advertisement_ID, Post_ID: Post_ID, Category_ID: Category_ID, StatusFilter_ID: StatusFilter_ID, adver_datef: adver_datef, adver_datet: adver_datet},
            success: function(data) {
                window.open(url1);
            }
        });
    });
});
</script>