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
                    <div class="card-header"><i class="fa fa-table"></i><?php echo (isset($ddata)?'Edit':'Add'); ?> Fee</div>
                    <div class="card-body">

                        <form method="post" action="<?php echo site_url('admin/Managefee/update/'.(isset($ddata)? $ddata->fee_id:'')); ?>">
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
                        <div class="form-group row">
                            <label class="col-md-3 mid_con">Category Name<font color="red">*</font></label>
                                <div class="col-md-8">
                                  <select name="category_id" class="form-control error" required="1">
                                    <option value="">select</option>
                                      <?php $preadver_id =   isset($ddata) ? set_value("cat_id", $ddata->cat_id) : set_value("cat_id");
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
                                <div class="form-group row">
                                    <label class="col-md-3 mid_con">Groups<font color="red">*</font></label>
                                        <div class="col-md-8">
                                  <select name="group_id" class="form-control error" required="1">
                                    <option value="">select</option>
                                      <?php $group_id =   isset($ddata) ? set_value("group_id", $ddata->group_id) : set_value("group_id");
                                      foreach($group as $value) {
                                           ?>
                                          <option value="<?php echo $value->id;?>"
                                          <?php if($group_id  == $value->id) { echo 'selected'; }  ?>
                                          ><?php echo $value->name;?></option>
                                          <?php
                                      }
                                      ?>
                                  </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 mid_con">Category Type<font color="red">*</font></label>
                                        <div class="col-md-8">
                                  <select name="category_type" class="form-control error" required="1">
                                  <?php $category_type= set_value('category_type', @$ddata->category_type);?>

                                    <option value="1" <?php if($category_type == 1) { echo 'selected'; }  ?>>Reserved</option>
                                    <option value="0" <?php if($category_type == 0) { echo 'selected'; }  ?>>Unreserved</option>
                                  </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 mid_con">Fee<font color="red">*</font></label>
                                       
                                        <div class="col-md-8">
                                        <input type="text" onkeypress="ValidateNumberOnly();" name="fee" value="<?php
                                         echo isset($ddata) ? set_value("fee", $ddata->fee) : set_value("fee"); ?>"
                                          data-date-inline-picker="true" placeholder="Fee" class="form-control error" required="1">
                                        <span class="form_error"><?php echo form_error('fee'); ?></span>
                                    </div>
                                </div>

                               <hr/>
                                    <div class="text-center">
                                        <button type="submit" id="srch" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i> Save</button>
                                        <a  href="<?php echo site_url('admin/Managefee/') ?>" type="reset" id="srch" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
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
<script>
 function ValidateNumberOnly()
{
if ((event.keyCode < 48 || event.keyCode > 57)) 
{
   event.returnValue = false;
}
}
    </script> 