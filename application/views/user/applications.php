<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
$user_id = $_SESSION['USER']['user_id'];


// here we select every column of the table
$status = array(5,1,7);

// $this->db->where('status_id',5);
$this->db->where('user_id', $user_id);
// $this->db->where_in('status_id',$status);
$this->db->where_in('status_id', $status);
$q = $this->db->get('users_detail');

// echo $this->db->last_query();
// die();
$data = $q->result_array();
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

                       

                        <h3>Applications</h3>
                        <table class="table table-bordered" id="tbl_Candidate">
                            <tbody>
                                    <tr style="background-color: #ffc107">
                                        <td style="color:white; font-weight:bold;">No.</td>
                                        <td style="color:white; font-weight:bold;">Application ID</td>
                                        <td style="color:white; font-weight:bold;">Post</td>
                                        <td style="color:white; font-weight:bold;">Name</td>
                                        <td style="color:white; font-weight:bold;">status</td>
                                        <td style="color:white; font-weight:bold;">Applied Date</td>
                                        <td style="color:white; font-weight:bold;">Action</td> 
                                </tr>
                                <?php
                                if(isset($data)){
                                    $i = 1;
                                    foreach($data as $application){?>
                                        <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $application['application_id']; ?></td>
                                        <?php
                                        //echo 'appid'.$application['post_id'];
                                        //echo $application['post_id'];
                                            $this->db->where('post_id', $application['post_id']);
                                            // here we select every column of the table
                                            $query = $this->db->get('jobpost');
                                            $jdata = $query->result_array();
                                           // print_r($jdata);
                                            
                                        ?>
                                        <td><?php if(!empty($jdata)){ echo $jdata[0]['post_name']; } ?></td>
                                        <td><?php echo $_SESSION['USER']['first_name'].' '.$_SESSION['USER']['last_name']; ?></td>
                                        <?php
                                        $this->db->where('status_id', $application['status_id']);
                                            // here we select every column of the table
                                            $query = $this->db->get('cand_profile_status_master');
                                            $sdata = $query->result_array();
                                        ?>
                                        <td><?php
                                        if(isset($sdata[0])){
                                            echo $sdata[0]['status_name'];
                                        }
                                        ?></td>
                                        <td><?php echo $application['created_on']; ?></td>
                                        <?php if($application['status_id']== 1 || $application['status_id'] == 7){ ?>
                                        <td><a target="_blank" href="<?php  echo site_url('Dashboard/get_all_data/' .base64_encode($application['application_id'])); ?>">Download</td>
                                     <?php }else{?> 
                                    
                                        <td>Fee status Pending</td>
                                   <?php }?>
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
        <!-- Main body End Here -->
</div>