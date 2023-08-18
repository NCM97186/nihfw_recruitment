                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    
                                    <label for="input-1">Advertisement </label><br>
                                    <?php $preadver_id =   isset($ddata) ? set_value("adver_id", $ddata->adver_id) : set_value("adver_id");
                                      $nop=get_advertisement_list();
                                      foreach($nop as $key_nop =>$value_nop) {
                                           ?>
                                          <?php if($preadver_id  == $key_nop) {echo $value_nop; }  ?>
                                          <?php
                                      }
                                      ?>
                                     <?php //echo $username; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                                <div class="form-group">
                                <label for="input-2">No. Of Jobs </label><br>
                                <?php echo $ddata->total_num_jobs; ?>
                                </div>
                            </div>  

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Post Name</label><br>
                                   <?php echo $ddata->post_name;?>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-1">Category Type</label><br>
                                    <?php if($ddata->category_type == 0){
                                        echo "Unreserved";
                                    }elseif ($ddata->category_type == 1) {
                                        echo "Reserved";
                                    }elseif($ddata->category_type == 1){
                                        echo "Both";
                                    }?> 
                                </div>
                            </div>
                            
                           
                             <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Fee Applicable</label><br>
                                   <?php  if($ddata->fee_applicable == 1){
                                    echo "YES";
                                   }else{ 
                                    echo "NO";
                                    }?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Group</label><br>
                                   <?php  $group = $this->db->select('name')->from('groups')->where('id',$ddata->group_id)->get()->row();
                                  echo $group->name;
                                  ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                                <div class="form-group">
                                <label for="input-2">Categories </label> <br>       
                            <?php $category= set_value('category', @$ddata->category);
                                    if(isset($ddata)){
                                        $selectedcategories = $ddata->categories;
                                        if($selectedcategories){
                                            $jobcategories = json_decode($selectedcategories);
                                            $jobcat = get_object_vars($jobcategories);
                                            $catjob = array_keys($jobcat);
                                            $catname = array_values($catjob);
                                            $catval = array_values($jobcat);
                                            $rescat = $this->db->select('*')->from('category')->where_in('id',$catname)->get()->result();
                                        }
                                    }
                                        for ($i=0; $i <count($rescat) ; $i++) {
                                           
                                        echo $rescat[$i]->category."-".$catval[$i];
                                        echo "<br>"; 
                                        }
                            ?> 
                                    </div>
                            </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                    <label for="input-3">Fees</label><br>
                             <?php 
                             if($ddata->fee_applicable == 1){
                             $res = get_fee_data($ddata->group_id);
                            for ($i=0; $i <count($res) ; $i++) { 
                                echo $res[$i]['category']."-".$res[$i]['fee'];
                                echo "<br>";
                            }
                        }else{
                            echo "NO";
                        }
                                ?>
                            </div>
                        </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Experience</label><br>
                                  <?php 
                                  $experience = $ddata->experience/365;
                                  if(empty($ddata->experience)){
                                    echo "Not Required";
                                  }else{
                                    if($experience == 1){
                                   echo $experience." Year";
                                  }else{
                                    echo $experience." Years";
                                  }} ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Apply Start Date</label><br>
                                  <?php echo $ddata->start_date; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Apply Last Date</label><br>
                                  <?php echo $ddata->last_date; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Min Age Date</label><br>
                                  <?php echo $ddata->min_age_date; ?>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Max Age Date</label><br>
                                  <?php echo $ddata->max_age_date; ?>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="input-3">Status</label><br>
                                  <?php if($ddata->post_status == 1){
                                    echo "Active";
                                  }else{
                                    echo "Inactive";
                                  } ?>
                                </div>
                            </div>
                           
                        </div>
                    
                       <a class="btn btn-success" href="<?php echo base_url('admin/JobPost/edit/'.$ddata->post_id);?>">Edit</a>
                   