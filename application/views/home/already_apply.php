<div class="btn offbtn">
<a href="<?php echo base_url() . "user/logout"; ?>"">Logout</a>
    </div>
    <a href="<?php echo base_url() . "dashboard/UserDashboard"; ?>"" style="float:left; margin-left:100px;">Dashboard</a>
<div class="contact-page-area container-fluid padding-bottom">
    <?php $this->load->view('common/user_tab.php');  
						//$last_date=$post_detail->last_date;
						$dob_age="";
						if(isset($user_details->dob)&&!empty($user_details->dob)){
							$dob_age=cal_diff_in_ymd_format($user_details->dob,$last_date);
						}?>
   
    <div class="container">
        <div id="national_form" class="container" style="text-align: center">

            <div class="panel panel-info national_form_border">

                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%">

                        <form method="post" id="notification-form" action="<?php echo base_url() . "dashboard/success";?>" enctype="multipart/form-data" novalidate="novalidate">
                            
                        <h3>You Have Already Applied This Post.</h3>
                           
                        </form>

                    </div>
                </div>

            </div>
        </div>
        <!-- Main body End Here -->
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/additional-methods.js"></script>