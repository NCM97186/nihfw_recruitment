
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('common/messages.php'); ?>

        <div class="row ">
            <div class="col-lg-12">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <i class="fa fa-table"></i> Admit Card
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="<?php echo base_url('admin/Admitcard/import'); ?>" class="editLink btn btn-success btn-sm ">Upload Admit Card(CSV)</a>
                        </div>
                    </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
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
                        <!--div> <button   id="exportexcel" target="_blank" class="btn btn-info" style="float:right;">Export</button></div-->
                        <div class="table-responsive">
                            <table id="default-datatabl" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Roll No</th>
                                        <th>Tier Exam </th>
                                        <th>Name Of The Applicant</th>
                                        <th>Post</th>
                                        <th>Exam Date & Time</th>
                                        <th>Exam Venu</th>
                                        <th>Category</th>
                                        <th>Gender</th>
                                        <th>Action</th>
                                        
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
                                                <td><?php echo $applicants->roll_no; ?></td>
                                                <td><?php echo $applicants->tier; ?></td>
                                                <td><?php echo $applicants->name; ?></td>
                                                <td><?php echo $applicants->post_name; ?></td>
                                                <td><?php echo $applicants->date; ?> <?php echo $applicants->time; ?></td>
                                                <td><?php echo $applicants->venu_address; ?></td>
                                                <td><?php echo $applicants->category_name; ?></td>
                                                <td><?php echo $applicants->gender; ?></td>
                                                <td> </td>
                                                
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
                </div>
            </div><!-- End Row-->


        </div>
        <!-- End container-fluid-->



    </div>
