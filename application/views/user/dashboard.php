<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
$user_id = $_SESSION['USER']['user_id'];
$this->db->where('user_id', $user_id);
// here we select every column of the table
$this->db->where('status_id',5);
$q = $this->db->get('users_detail');
$data = $q->result_array();
// echo '<pre>';
// print_r($data);
// echo '</pre>';



?>
<div style=display:flex;>


<?php
  $this->load->view('user/sidebar.php');
?>



<!-- <a href="<?php echo base_url() . "user/ChangePassword"; ?>"">Change password</a>
<div class="btn offbtn">
    
<a href="<?php echo base_url() . "user/logout"; ?>"">Logout</a>
    </div> -->
<div id="main" class="w-100 container">
<button class="openbtn" onclick="openNav()">☰</button>
            <div class="panel container panel-info national_form_border" style="overflow-y: scroll; height: 70vh;">

                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%">

                        <form method="post" action="<?php echo base_url('dashboard/basicinfo')?>" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />    
                        <table class="table table-bordered" id="tbl_Candidate">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align: left; width: 100%;">
                                            <table align="left" class="table table-bordered" style="width: 100%" id="tblcndt">
                                                <tbody>
                                                <tr>
                                                        <td align="left" style="width: 20%;">
                                                            <span id=""><b>Registration Number</b></span>
                                                        </td>
                                                        <td colspan="5" align="left" style="width: 80%;">
                                                            
                                                            <?php echo set_value("registration_number", @$basic_info->registration_number); ?>
                                                            
                                                            
                                                        </td>

                                                </tr>
                                                    <tr>
                                                        <td align="left" style="width: 20%;">
                                                            <span id=""><b>First Name</b></span>
                                                        </td>
                                                        <td align="left" style="">
                                                            
                                                            <?php echo set_value("first_name", @$basic_info->first_name); ?>
                                                           
                                                            
                                                        </td>
                                                        <td align="left" style="width: 15%;">

                                                            <span id=""><b>Middle Name </b></span>
                                                        </td>
                                                        <td align="left" style="">
                                                            <?php echo set_value("middel_name", @$basic_info->middel_name); ?>
                                                            
                                                        </td>
                                                        <td align="left" style="width: 15%;">

                                                            <span id=""><b>Last Name </b></span>
                                                         </td>
                                                        <td align="left" style="">
                                                            <?php echo set_value("last_name", @$basic_info->last_name); ?>
                                                            
                                                        </td>

                                                    </tr>
                                                   


                                                    <tr>
                                                        <td align="left" style="width: 20%;">
                                                            <span ><b>Mobile No</b></span>
															
                                                        </td>
                                                        <td colspan="2" align="left" style="">
                                                            <div class="form-inline">
                                                                <span class="form-control" maxlength="3" readonly="True" style="display:inline-block;color:Navy;width:50px;">+91 </span>
                                                                -
                                                                <?php echo set_value("cand_mob", @$basic_info->cand_mob); ?>
                                                            </div>
                                                           
                                                          </td>
                                                          <td align="left" style="width: 15%;">
                                                            <span id=""><b>E-mail ID</b></span>
                                                        </td>
                                                        <td colspan="2" align="left" style="">
                                                            <?php echo set_value("cand_email", @$basic_info->cand_email); ?>
                                                            
                                                        </td>
                                                    </tr>

                                                    <!-- <tr>
                                                        <td align="right" style="width: 20%;">
                                                            <span id="">E-mail ID </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 80%;">
                                                            <?php echo set_value("cand_email", @$basic_info->cand_email); ?>
                                                            
                                                        </td>
                                                    </tr> -->


                                                </tbody>
                                            </table>


                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </form>

                      

                    </div>
                </div>
                <div class="contact-page-area padding-bottom">
    <div class="container-fluid">
        <div id="national_form m-0" style="text-align: center">
            <div class="panel panel-info">
                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%;overflow-x:auto;display: block;">
                        <table class="table table-bordered" id="tbl_Candidate">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-left"></td>
                                </tr>
                                <tr class="bg-info">
                                    <td colspan="2" class="heading2" align="center">
                                        <span>*** All Notifications/Advertisements Details ***</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="heading2" align="center"></td>
                                </tr>


                                <tr style="font-size: 12pt">
                                    <td colspan="2" style="text-align: left">
                                        <div style="text-align: left">
                                            <table id="dynamic_field" class="table table-bordered" style="width: 100%">
                                                <thead>
                                                    <tr class="bg-danger">
                                                        <td align="center" style="font-weight: 400; color: white;" valign="top">Sr.No.</td>
                                                        <td align="center" style="font-weight: 400; color: white;" valign="top">Examination Name</td>
                                                        <td align="center" style="font-weight: 400; color: white;" valign="top">Advt. Number , Date</td>
                                                        <td align="center" style="font-weight: 400; color: white;" valign="top">Start Date</td>
                                                        
                                                        <td align="center" style="font-weight: 400; color: white;" valign="top">Form Submission Last Date</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  
                                                    // echo "<pre>";
                                                    // print_r($result);
                                                    // die();
                                                    $i = 1;
                                                    foreach ($result as $results) { ?>


                                                    <tr>
                                                        <td align="center">
                                                            <strong><?php echo $i; ?></strong>
                                                        </td>
                                                        <td align="center"><?php echo $results->post_name; ?></td>
                                                        <td align="center"><?php echo $results->adver_no.",".$results->adver_date; ?></td>
                                                        <td align="center"><?php echo date("d-m-Y", strtotime($results->start_date)); ?></td>
                                                        <td align="center"><?php echo date("d-m-Y", strtotime($results->last_date)); ?></td>
                                                        
                                                        <td align="center">
                                                            <?php if($results->link_to_pdf!='pending'){?>
                                                                <a class="btn btn-info" href="<?php echo base_url() ?>uploads/link_to_pdf/<?php echo $results->link_to_pdf; ?>" target="_New"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View Advertisement</a>
                                                            <?php } ?>
                                                        </td>
                                                        
                                                        <td align="center">
                                                         <?php if(isset($_SESSION['USER']['user_id'])){?>
                                                            <a id="apply_post" onClick="saveCookie(<?php echo $results->post_id; ?>)" class="btn btn-success" data-post="<?php echo $results->post_id; ?>" href="<?php echo base_url('dashboard/basicinfo') ?>"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Apply</a>
                                                        <?php } else{ ?>
                                                             <a id="apply_post" onClick="saveCookie(<?php echo $results->post_id; ?>)" class="btn btn-success" data-post="<?php echo $results->post_id; ?>" href="<?php echo base_url('user/login') ?>"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Apply</a>
                                                        <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main body End Here -->
    </div>
</div>
            </div>
        </div>
        
        <!-- Main body End Here -->
</div>
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>

let table = new DataTable('#dynamic_field');
</script>
<script>
    function setCookie(key, value, expiry) {
        var expires = new Date();
        expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
        document.cookie = key + '=' + value + ';path=/;expires=' + expires.toUTCString();
        
    }
    function saveCookie(id){
        setCookie('post_id',id,'1');
    }
    
</script>
