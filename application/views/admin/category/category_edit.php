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
                    <div class="card-header"><i class="fa fa-table"></i> <?php echo (isset($ddata)?'Edit':'Add'); ?> Category</div>
                    <div class="card-body">

                        <form method="post" action="<?php echo site_url('admin/Category/update/'.(isset($ddata)? $ddata->id:'')) ?>">
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
                                <div class="form-group row">
                                    <label class="col-md-3" style="margin-top:10px; text-align: center;">Category Name <font color="red">*</font></label>
                                       
                                        <div class="col-md-8">
                                        <input type="text" name="category" value="<?php
                                         echo isset($ddata) ? set_value("category", $ddata->category) : set_value("category"); ?>"
                                          data-date-inline-picker="true" placeholder="Category Name" class="form-control error">
                                        <span class="form_error"><?php echo form_error('category'); ?></span>
                                    </div>
                                </div>

                               <hr/>
                                    <div class="text-center">
                                        <button type="submit" id="srch" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i> Save</button>
                                        <a  href="<?php echo site_url('admin/category/') ?>" type="reset" id="srch" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
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