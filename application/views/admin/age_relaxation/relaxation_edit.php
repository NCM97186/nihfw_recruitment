<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('common/messages.php'); ?>

        <div class="row ">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i><?php echo (isset($ddata)?'Edit':'Add'); ?> Age Relaxation</div>
                    <div class="card-body">

                        <form method="post" action="<?php echo site_url('admin/Agerelaxation/update/'.(isset($ddata)? $ddata->id:'')); ?>">
                        <!-- <input type="hidden" name="<?php //echo $csrf['name'];?>" value="<?php //echo $csrf['hash'];?>" /> -->
                        <div class="form-group row">
                                    <label class="col-md-3 mid_con">Category Name<font color="red">*</font></label>
                                        <div class="col-md-8">
                                           
                                  <!-- <select name="category_id" class="form-control error" id="category" required="1" > -->
                                  <select name="category_id" class="form-control error" required="1" id="category" onchange="categories()">
                                    <option value="">select</option>
                                      <?php $preadver_id =   isset($ddata) ? set_value("catid", $ddata->catid) : set_value("catid");
                                      foreach($category as $value) {
                                           ?>
                                          <option value="<?php echo $value->id;?>"
                                          <?php if($preadver_id  == $value->id) { echo 'selected'; }  ?>
                                          ><?php echo $value->category;?></option>
                                          <?php
                                      }
                                      ?>
                                  </select>
                                    </div>
                                </div>
                                <!-- <table class="" id="a1" name="category_proof" style="display:none;">
                                                         <tr>  
															<td align="right" style="width: 40%;">
																										
													<?php //$ex_serviceman_category= set_value('ex_serviceman_category', @$ddata->ex_serviceman_category);?>
                                                    <input type="radio" name="ex_serviceman_category" value="UR" <?php //if($ex_serviceman_category=='UR'){?> checked <?php //}?> <?php //echo set_radio('category', 'SC'); 
                                                                                                        ?>> UR
                                                        <input type="radio" name="ex_serviceman_category" value="OBC" <?php //if($ex_serviceman_category=='OBC'){?> checked <?php //}?> <?php //echo set_radio('category', 'OBC'); 
                                                                                                        ?>> OBC
                                                        <input type="radio" name="ex_serviceman_category" value="ST" <?php //if($ex_serviceman_category=='ST'){?> checked <?php //}?> <?php //echo set_radio('category', 'ST'); 
                                                                                                        ?>> ST
                                                        <input type="radio" name="ex_serviceman_category" value="SC" <?php //if($ex_serviceman_category=='SC'){?> checked <?php //}?> <?php //echo set_radio('category', 'SC'); 
                                                                                                        ?>> SC
                                                        <input type="radio" name="ex_serviceman_category" value="SC" <?php //if($ex_serviceman_category=='SC'){?> checked <?php //}?> <?php //echo set_radio('category', 'SC'); 
                                                                                                        ?>> EWS
                                                        
                                                        <input type="radio" name="category" value="OH" > OH-->
                                                        <!-- <span class="form_error">     <?php //echo form_error('ex_serviceman_category');       ?></span>
														 </td></tr> -->
                                <!-- </table> -->
                                <div class="form-group row">
                                    <label class="col-md-3 mid_con">PWBD<font color="red">*</font></label>
                                        <div class="col-md-8">
                                  <select name="Person_disablity" class="form-control error" required="1">
                                  <?php $Person_disablity= set_value('Person_disablity', @$ddata->Person_disablity);?>

                                    <option value="1" <?php if($Person_disablity == 1) { echo 'selected'; }  ?>>YES</option>
                                    <option value="0" <?php if($Person_disablity == 0) { echo 'selected'; }  ?>>NO</option>
                                  </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 mid_con">Age Relaxation <font color="red">*</font></label>
                                       
                                        <div class="col-md-8">
                                        <input type="text" name="relaxation" value="<?php
                                         echo isset($ddata) ? set_value("relaxation", $ddata->relaxation) : set_value("relaxation"); ?>"
                                          data-date-inline-picker="true" placeholder="Age Relaxation" class="form-control error" required="1">
                                        <span class="form_error"><?php echo form_error('relaxation'); ?></span>
                                    </div>
                                </div>

                               <hr/>
                                    <div class="text-center">
                                        <button type="submit" id="srch" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i> Save</button>
                                        <a  href="<?php echo site_url('admin/Agerelaxation/') ?>" type="reset" id="srch" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
                                    </div>

                            </div>
                        </form>
                    </div>
                </div>
            
                </div>
            </div>
        </div><!-- End Row-->


    </div>
    <!-- End container-fluid-->
</div>
<script type="text/javascript">

// function categories() {
// 			var category=document.getElementById('category').value;
// 			if (category == 7) {
//               document.getElementById('a1').style.display = "block"
//              } else{
//                document.getElementById('a1').style.display = "none"
//             }
//        }

       
//        $(function(){
//         categories();
// });

</script>