<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
?>
<style>
.mid_con {
    padding-top: 10px;
    vertical-align: middle;
    text-align: center;
}
</style>
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('common/messages.php'); ?>
<!-- this is form for add new and edit record  -->
        <div class="row ">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> <?php echo (isset($ddata)?'Edit':'Add'); ?> Post</div>
                    <div class="card-body">
    <?php //print_r($ddata);die; ?>
    <?php //echo site_url('admin/Advertisement/update/'.(isset($ddata)? $ddata->$adver_id :'0'));die; ?>
                        <form method="post" action="<?php echo site_url('admin/JobPost/update/'.(isset($ddata)? $ddata->post_id :'0')) ?>">
                        <!-- <input type="hidden" name="<?php //echo $csrf['name'];?>" value="<?php //echo $csrf['hash'];?>" /> -->
                          <div class="form-group row">
                                  <label class="col-md-3 mid_con">Advertisement  <font color="red">*</font></label>
                                  <div class="col-md-8">
                                  <select name="adver_id" class="form-control error">
                                    <option value="">Select</option>
                                      <?php $preadver_id =   isset($ddata) ? set_value("adver_id", $ddata->adver_id) : set_value("adver_id");
                                      $nop=get_advertisement_list();
                                      foreach($nop as $key_nop =>$value_nop) {
                                           ?>
                                          <option value="<?php echo $key_nop;?>"
                                          <?php if($preadver_id  == $key_nop) { echo 'selected'; }  ?>
                                          ><?php echo $value_nop;?></option>
                                          <?php
                                      }
                                      ?>
                                  </select>
                                  <span class="form_error"><?php echo form_error('adver_id'); ?></span>
                              </div>
                          </div>
                         
                          <div class="form-group row">
                                    <label class="col-md-3 mid_con">No. Of Jobs <font color="red">*</font></label>

                                        <div class="col-md-8">
                                        <input type="Number" onkeypress="ValidateNumberOnly();" name="total_num_jobs" value="<?php
                                         echo isset($ddata) ? set_value("total_num_jobs", $ddata->total_num_jobs) : set_value("total_num_jobs"); ?>"
                                          data-date-inline-picker="true" placeholder="No. Of Jobs" class="form-control error">
                                        <span class="form_error"><?php echo form_error('total_num_jobs'); ?></span>
                                    </div>
                                </div>
                              
                                <!-- <table class="" id="a1" name="categories"> -->
                            <div class="form-group row">
                                <label class="col-md-3 mid_con">Categories<font color="red">*</font>
                                <span style="text-transform:lowercase !important" class="form_error"><?php echo form_error('category[]'); ?></span>  </label>   
                                               
                                <div class="col-md-8">															
									<?php $category= set_value('category', @$ddata->category);
                                    if(isset($ddata)){
                                        $selectedcategories = $ddata->categories;
                                        if($selectedcategories){
                                            $jobcategories = json_decode($selectedcategories);
                                            $jobcat = get_object_vars($jobcategories);
                                            $catjob = array_keys($jobcat);
                                            $catval = array_values($jobcat);
                                        }
                                    }
                                   
                                    $i = 0;
                                    if(isset($categories)){
                                    foreach($categories as $value) {?>
                                    <div class="d-flex" style="gap:50px;">
                                        <div class="d-flex">
                                            <div style="width:100px; align-items:center;" class="d-flex">
                                                <?php echo $value->category; ?>
                                            </div>
                                            <div class="d-flex vertical-align-middle">
                                                <?php
                                                if(isset($selectedcategories)){?>
                                                     <input type="checkbox" onclick="showquatity()"  name="category[]" id="category"  value="<?php echo $value->id;?>"
                                                <?php if(array_key_exists($i,$catjob)){ if($catjob[$i]  == $value->id) { echo 'checked'; } } ?>/> 
                                                <?php } else{?>
                                                    <input type="checkbox" onclick="showquatity()"   name="category[]" id="category"  value="<?php echo $value->id;?>"
                                                /> 
                                                <?php }
                                                ?>
                                               
                                            </div>
                                        </div>

                                    <div>
                                     
                                          <label>Quantity</label>
                                          <div class="col-md-2">
                                          <?php
                                            if(isset($selectedcategories)){?>
                                                <input type="text"  onkeypress="ValidateNumberOnly();" name="post_quatity[]" id="post_quatity" value="<?php if(array_key_exists($i,$catval)){ echo $catval[$i]; } ?>">
                                            <?php }else{?>
                                                <input type="text" onkeypress="ValidateNumberOnly();" name="post_quatity[]" id="post_quatity" value="" readonly="readonly">
                                            <?php }
                                          ?>
                                          </div>  
                                       
                                    </div>

                                    <!-- <div>
                                    <label>Category Type</label>
                                        <div class="">
                                        <select name="category_type[]" class="form-control error">
                                           
                                        <?php //$category_type= set_value('category_type', @$ddata->category_type);?>
                                            <option value=" ">Select</option>
                                            <option value="1" <?php //if($category_type == 1) { echo 'selected'; }  ?>>Reserved</option>
                                            <option value="0" <?php //if($category_type == 0) { echo 'selected'; }  ?>>Unreserved</option>
                                
                                        </select>
                                    </div>
                                     </div> -->

                                    </div>
                                    <?php
                                    $i++;
                                    }
                                 } ?>
                                    
                                </div>                          
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 mid_con">Category Type<font color="red">*</font></label>
                                        <div class="col-md-8">
                                  <select name="category_type" class="form-control error">
                                  <?php $category_type= set_value('category_type', @$ddata->category_type);?>

                                    <option value="1" <?php if($category_type == 1) { echo 'selected'; }  ?>>Reserved</option>
                                    <option value="0" <?php if($category_type == 0) { echo 'selected'; }  ?>>Unreserved</option>
                                    <option value="2" <?php if($category_type == 2) { echo 'selected'; }  ?>>Both</option>
                                  </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 mid_con">Post Name <font color="red">*</font></label>

                                        <div class="col-md-8">
                                        <input type="text" name="post_name" value="<?php
                                         echo isset($ddata) ? set_value("adver_no", $ddata->post_name) : set_value("post_name"); ?>"
                                          data-date-inline-picker="true" placeholder="Post Name" class="form-control error">
                                        <span class="form_error"><?php echo form_error('post_name'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 mid_con">Fee Applicable<font color="red">*</font></label>
                                        <div class="col-md-8">
                                  <select name="fee_applicable" id="fee_applicable" class="form-control error">
                                  <?php $fee_applicable= set_value('fee_applicable', @$ddata->fee_applicable);?>

                                    <option value="1" <?php if($fee_applicable == 1) { echo 'selected'; }  ?>>Yes</option>
                                    <option value="0" <?php if($fee_applicable == 0) { echo 'selected'; }  ?>>NO</option>
                                  </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-md-3 mid_con">Groups<font color="red">*</font></label>
                                <div class="col-md-8">
                                  <select name="group_id" id="group_id" class="form-control error" >
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
                                <span class="form_error"><?php echo form_error('group_id'); ?></span>
                                </div>
                               
                                </div>
                                <div class="form-group row">
                                <label class="col-md-3 mid_con">Categories<font color="red">*</font></label>
                                <div class="col-md-8" name="fee_categories" id="fee_categories">
                                 
                                
                                </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label class="col-md-3 mid_con">Fee <font color="red">*</font></label>

                                    <div class="col-md-8">
                                        <input type="text" onkeypress="ValidateNumberOnly();" name="fee" value="<?php
                                        //  echo isset($ddata) ? set_value("fee", $ddata->fee) : set_value("fee"); ?>"
                                          data-date-inline-picker="true" placeholder="Fee" class="form-control error">
                                        <span class="form_error"><?php //echo form_error('fee'); ?></span>
                                    </div>
                                </div> -->

                                <div class="form-group row">
                                    <label class="col-md-3 mid_con">Experience</label>

                                        <div class="col-md-8">
                                        <input type="text" name="experience" value="<?php
                                         echo isset($ddata) ? set_value("experience", $ddata->experience) : set_value("experience"); ?>"
                                          data-date-inline-picker="true" placeholder="Experience" onkeypress="ValidateNumberOnly();" class="form-control error" maxlength="2">
                                        <span class="form_error"><?php echo form_error('experience'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 mid_con">Apply Start Date  <font color="red">*</font></label>

                                        <div class="col-md-8">
                                        <input id="date-picker" type="date" name="start_date" onchange="Validatestartapplydate();"  value="<?php
                                         echo isset($ddata) ? set_value("start_date", $ddata->start_date) : set_value("start_date"); ?>"
                                          data-date-inline-picker="true" placeholder="Start Date" class="form-control error">
                                        <span class="form_error"><?php echo form_error('start_date'); ?></span>
                                        <p id="error_start" style="color:red"></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 mid_con">Apply Last Date  <font color="red">*</font></label>

                                        <div class="col-md-8">
                                        <input id="date_last" type="date" name="last_date" onchange="ValidateEndapplydate();"   value="<?php
                                         echo isset($ddata) ? set_value("last_date", $ddata->last_date) : set_value("last_date"); ?>"
                                          data-date-inline-picker="true" placeholder="Last Date" class="form-control error">
                                        <span class="form_error"><?php echo form_error('last_date'); ?></span>
                                        <p id="error_end" style="color:red"></p>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 mid_con">Min Age Date  <font color="red">*</font></label>

                                        <div class="col-md-8">
                                        <input type="date" name="min_age_date" id="min_age_date" onchange="dateAgo('Min',this.value);" value="<?php
                                         echo isset($ddata) ? set_value("min_age_date", $ddata->min_age_date) : set_value("min_age_date"); ?>"
                                          data-date-inline-picker="true" placeholder="Last Date" class="form-control error">
                                         <span class="form_error"><?php echo form_error('min_age_date'); ?></span>
                                         <p id="error_min_age" style="color:red"></p>
                                         <p id="min_age"></p>
                                      </div>
                                </div>
								               <div class="form-group row">
                                    <label class="col-md-3 mid_con">Max Age Date  <font color="red">*</font></label>
                                   
                                        <div class="col-md-8">
                                        <input type="date" name="max_age_date" id="max_age_date" onchange="dateAgo('Max',this.value);" value="<?php
                                         echo isset($ddata) ? set_value("max_age_date", $ddata->max_age_date) : set_value("max_age_date"); ?>"
                                          data-date-inline-picker="true" placeholder="Last Date" class="form-control error">
                                         <span class="form_error"><?php echo form_error('max_age_date'); ?></span>
                                         <p id="error_max_age" style="color:red"></p>
                                         <p id="max_age"></p>
                                      </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-md-3 mid_con">Post Status  <font color="red">*</font></label>
                                        <div class="col-md-8">
                                        <select name="post_status" class="form-control error">
                                            <?php $set_status =   isset($ddata) ? set_value("post_status", $ddata->post_status) : set_value("post_status");

                                                ?>
                                                <option value=''>--Select Post Status--</option>
                                                <option value="1"
                                                <?php if($set_status  == 1) { echo 'selected'; }  ?>
                                                >Enabled</option>
                                                <option value="2"
                                                <?php if($set_status  == 2) { echo 'selected'; }  ?>
                                                >Disabled</option>

                                        </select>
                                        <span class="form_error"><?php echo form_error('post_status'); ?></span>
                                    </div>
                                </div>

                               <hr/>
                                    <div class="text-center">
                                        <button type="submit" id="srch" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i> Save</button>
                                        <a  href="<?php echo site_url('admin/JobPost/') ?>" type="reset" id="srch" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
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

    $('#group_id').on('change', function (e) {
        var group_id = $(this).val();
        var fee = $('#fee_applicable').val();

        $.ajax({
            
            url: "<?php echo base_url('admin/JobPost/get_groupby_data'); ?>",
            type: "post",
            data: {'group_id': group_id},
            success: function (data) {
                //alert(data);
                $("#fee_categories").html('');
                    var new_data = $.parseJSON(data);
                    $.each(new_data, function (i, item) {
                         //Start By kesh 

                         if(fee == 0){
                        return false;
                        }
                        
                        // End By Kesh
                        $('#fee_categories').append($('<p>', { 
                            text : item.category + ":  " + item.fee +  "\n"

                        }));
                    });
               

            },
            complete: function (aa, bb) {
               
                
            }
        });
    });
    </script>

<script>
const datePicker = document.getElementById("date-picker");

datePicker.min = getDate();
datePicker.max = getDate(10000000000000000);

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
<script>
const datePickers = document.getElementById("date_last");

datePickers.min = getDates();
datePickers.max = getDates(10000000000000000);

// Borrowed from https://stackoverflow.com/a/29774197/7290573
function getDates(days) {
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

<script>
 function ValidateNumberOnly()
{
if ((event.keyCode < 48 || event.keyCode > 57)) 
{
   event.returnValue = false;
}
}
</script>
<script>
function Validatestartapplydate()
{
    var startdate = $('#date-picker').val();
    var enddate   = $('#date_last').val();

    var date_start = new Date(startdate);
    var date_end   = new Date(enddate);
    if(date_start > date_end )
        {
            // $('#date_last').val("");
            $("#error_start").html("Start Date Should Be Less Than Last Date").addClass("error-msg");
            return false; 
        }
}
function ValidateEndapplydate()
{
    var startdate = $('#date-picker').val();
    var enddate   = $('#date_last').val();

    var date_start = new Date(startdate);
    var date_end   = new Date(enddate);
    if(date_start > date_end )
        {
            // $('#date_last').val("");
            $("#error_end").html("Last Date Should Be Greater Than Start Date").addClass("error-msg");
            return false; 
        }
}

// function ValidateMinAgedate()
// {
//     var minagedate = $('#min_age_date').val();
//     var maxagedate   = $('#max_age_date').val();

//     var Min_date = new Date(minagedate);
//     var Max_date   = new Date(maxagedate);
//     if(Min_date > Max_date)
//         {
//             //$('#max_age_date').val("");
//             $("#error_min_age").html("Min Age Should Be Less Than Max Age").addClass("error-msg");
//             return false; 
//         }
// }
// function ValidateMaxAgedate()
// {
//     var minagedate = $('#min_age_date').val();
//     var maxagedate   = $('#max_age_date').val();

//     var Min_date = new Date(minagedate);
//     var Max_date   = new Date(maxagedate);
//     if(Min_date > Max_date)
//         {
//             //$('#max_age_date').val("");
//             $("#error_max_age").html("Max Age Should Be Greater Than Min Age").addClass("error-msg");
//             return false; 
//         }
// }
function showquatity()
{

$('input[readonly]').click(function () {
  $(this).removeAttr('readonly');
})

}
</script>  
<style>
input[readonly] {
  color: gray;
  border-color: currentColor;
}
</style>
<script>
    //kesh
        function dateAgo(type,date) {
            var dobdate = date.split('-');
            var dobmonth = dobdate[1] - 1;
            var age_type = type; 
            var currentmonth = new Date().getMonth() + 1;

            var dob = new Date(date);
            var dobYear = dob.getFullYear();
            const today = new Date();

            var calculated_days = 0;
            if (dob.getDate() > 1) {
                var calculated_days = 31 - dob.getDate();
                dobmonth = dobmonth + 1;
            }
            if (dobmonth <= 6) {
                var calculated_month = 6 - dobmonth;
            } else {
                var calculated_month = 18 - dobmonth;
                dobYear = dobYear + 1;
            }

            if (currentmonth <= 7) {
                var yyyy = today.getFullYear();
            } else {
                var yyyy = today.getFullYear();

            }
            var as_on_date = new Date(07 + '-' + 01 + '-' + yyyy);
            var view_on_date = 01 + '-' + 07 + '-' + yyyy;
            var calculated_year = yyyy - dobYear;
            var no_of_days = parseInt((as_on_date.getTime() - dob.getTime()) / (1000 * 3600 * 24)) + 1

            //alert("no of days "+ no_of_days);
           

            // alert(type);
            if (type == "Min") {
                var returndata ="Min Age " + calculated_year + " Years " + calculated_month + " Month and " + calculated_days + " Days "
                $('#min_age').html(returndata); 
            }
            if(type == "Max"){
                var returndata ="Max Age " + calculated_year + " Years " + calculated_month + " Month and " + calculated_days + " Days "
                $('#max_age').html(returndata);
            }
            // alert(returndata);
           
            // $('#dob_calcdate').html(view_on_date);
            // $('#candtotal_age').val(no_of_days);
            return;
            //End kesh
        }
    </script>