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
                    <div class="card-header"><i class="fa fa-table"></i><?php echo (isset($ddata)?'Edit':'Add'); ?> Subcategory</div>
                    <div class="card-body">

                        <form method="post" action="<?php echo site_url('admin/Subcategory/update/'.(isset($ddata)? $ddata->id:'')); ?>">
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
                        <div class="form-group row">
                                    <label class="col-md-3 mid_con">Category Name<font color="red">*</font></label>
                                        <div class="col-md-8">
                                  <select name="category_id" class="form-control error" required="1">
                                    <option value="">select</option>
                                      <?php $preadver_id =   isset($ddata) ? set_value("category_id", $ddata->category_id) : set_value("category_id");
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
                                    <label class="col-md-3 mid_con">Subcategory Name <font color="red">*</font></label>
                                       
                                        <div class="col-md-8">
                                        <input type="text" name="subcategory" value="<?php
                                         echo isset($ddata) ? set_value("subcategory", $ddata->subcategory) : set_value("subcategory"); ?>"
                                          data-date-inline-picker="true" placeholder="subcategory Name" class="form-control error">
                                        <span class="form_error"><?php echo form_error('subcategory'); ?></span>
                                    </div>
                                </div>

                               <hr/>
                                    <div class="text-center">
                                        <button type="submit" id="srch" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i> Save</button>
                                        <a  href="<?php echo site_url('admin/Subcategory/') ?>" type="reset" id="srch" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
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