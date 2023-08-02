<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <?php
        $this->load->view('common/messages.php'); ?>
<!-- this is form for add new and edit record  -->
        <div class="row ">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> <?php echo (isset($ddata)?'Edit':'Add'); ?> Advertisement</div>
                    <div class="card-body">
<?php //print_r($ddata);die; ?>
<?php //echo site_url('admin/Advertisement/update/'.(isset($ddata)? $ddata->$adver_id :'0'));die; ?>
                        <form method="post" enctype="multipart/form-data" action="<?php echo site_url('admin/Advertisement/update/'.(isset($ddata)? $ddata->adver_id :'0')) ?>">
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
                                <div class="form-group row">
                                     <label class="col-md-12">Advertisement No <font color="red">*</font></label>

                                        <div class="col-md-12">
                                        <input type="text" name="adver_no" value="<?php
                                         echo isset($ddata) ? set_value("adver_no", $ddata->adver_no) : set_value("adver_no"); ?>"
                                          data-date-inline-picker="true" placeholder="Advertisement No" class="form-control error">
                                        <span class="form_error"><?php echo form_error('adver_no'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12">Advertisement Title <font color="red">*</font></label>

                                        <div class="col-md-12">
                                        <textarea name="adver_title"  rows="3"
                                          data-date-inline-picker="true" placeholder="Advertisement Title" class="form-control error"><?php
                                           echo isset($ddata) ? set_value("adver_no", $ddata->adver_title) : set_value("adver_title"); ?></textarea>
                                        <span class="form_error"><?php echo form_error('adver_title'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12">Advertisement File<font color="red">*</font></label>

                                        <div class="col-md-12">
                                        <input type="file" name="link_to_pdf" value="<?php 
                                       echo isset($ddata) ? set_value("link_to_pdf", $ddata->link_to_pdf) : set_value("link_to_pdf"); ?>"
                                          data-date-inline-picker="true" placeholder="Load Advertisement" class="form-control error">
										   <?php if (isset($ddata->link_to_pdf)) { ?>
                                                           <input type="hidden" name="old_link_to_pdf" value="<?php echo @$ddata->link_to_pdf; ?>">
                                                        <?php } ?>
                                         <span><b><?php echo @$ddata->link_to_pdf; ?><b></span>    
                                         <br>
                                         <!-- <iframe src="<?php //echo base_url('uploads/link_to_pdf/').$ddata->link_to_pdf; ?>" style="width:180px; height:150px;" frameborder="0"></iframe> -->
        
                                        <span class="form_error"><?php echo form_error('link_to_pdf'); ?></span>
                                        <span><b>File size limit 3MB</b></span><br>
                                        <span><b>Please select doc,docx,pdf,jpg,jpeg,png format file<b></span>
                                     

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12">Advertisement Date  <font color="red">*</font></label>

                                        <div class="col-md-12">
                                        <input id="date-picker" type="date" name="adver_date" value="<?php
                                         echo isset($ddata) ? set_value("adver_date", $ddata->adver_date) : set_value("adver_date"); ?>"
                                          data-date-inline-picker="true" placeholder="Advertisement Date" class="form-control error">
                                        <span class="form_error"><?php echo form_error('adver_date'); ?></span>
                                    </div>
                                </div>

                               <hr/>
                                    <div class="text-center">
                                        <button type="submit" id="srch" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i> Save</button>
                                        <a  href="<?php echo site_url('admin/Advertisement/') ?>" type="reset" id="srch" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
                                        <!-- <button type="button" class="btn btn-warning px-5" data-dismiss="modal"><i aria-hidden="true" class="fa fa-paper-plane"></i>Close</button> -->
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
const datePicker = document.getElementById("date-picker");

datePicker.min = getDate();
datePicker.max = getDate(10000000000000);

// Borrowed from https://stackoverflow.com/a/29774197/7290573
function getDate(days) {
    let date;

    if (days !== undefined) {
        date = new Date(Date.now() + days * 24 * 60 * 60 * 1000);
    } else {
        date = new Date();
    }

    const offset = date.getTimezoneOffset();

    date = new Date(date.getTime() - (offset*60*1000));

    return date.toISOString().split("T")[0];
}
</script>

