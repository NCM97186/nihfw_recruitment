<style>
    html{
        height:100%;
        box-sizing:border-box;
    }
    body{
        box-sizing:inherit;
        overflow-y:hidden;
    }
.mystyle{
    width:250px !important;
}
.sidebar {
    height: 1000px !important;
    width: 0;
    position: sticky;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #337ab7;
    overflow-x: hidden;
    transition: 0.5s;
    margin-top:16px;
    padding-top: 10px;
    z-index: 0;
  }
  
  .sidebar a {
    padding: 2px 8px 8px 10px;
    text-decoration: none;
    font-size: 16px;
    color: #fff;
    display: block;
    transition: 0.3s;
    white-space: nowrap;
  }
.sidebar hr{
    margin:0 !important;
}
  
  .sidebar a:hover {
    color: #f1f1f1;
  }
  
  .sidebar .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
    display:none;
  }
  
  .openbtn {
    font-size: 20px;
    cursor: pointer;
    background-color: #111;
    color: white;
    padding: 10px 15px;
    border: none;
    display:none;
  }
  
  .openbtn:hover {
    background-color: #444;
  }
  
  #main {
    transition: margin-left .5s;
    padding: 16px;
  }
.d-flex{
    display:flex;
}
.justify-content-center{
    justify-content:center;
}
.p30{
    padding-left: 30px;
    align-items:center;
}
  
  /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
  /* @media screen and (max-height: 450px) {
    .sidebar {padding-top: 15px;}
    .sidebar a {font-size: 14px;}
  } */

  @media only screen and (min-width: 330px) {
    .sidebar{
        height: 100%;
        position: fixed !important;
        width:0px
    }
    .openbtn{
        display:block !important;
    }
    .closebtn{
        display:block !important;
    }
  }
  
  /* Medium devices (landscape tablets, 768px and up) */
  @media only screen and (min-width: 768px) {
    .sidebar{
        height: 100%;
        position: fixed !important;
        width: 250px ;
    }
    .openbtn{
        display:none !important;
    }
    .closebtn{
        display:none !important;
    }
  } 
  
  /* Large devices (laptops/desktops, 992px and up) */
  @media (min-width: 992px) {
    .panel{
        width:100% !important;
        max-width:1140px !important;
    }
    .sidebar{
        position:sticky !important;
        width: 250px !important;
    }
    .openbtn{
        display:none !important;
    }
    .closebtn{
        display:none !important;
    }
  } 
  
  /* Extra large devices (large laptops and desktops, 1200px and up) */
  @media only screen and (min-width: 1200px) {
    .sidebar{
        position:sticky !important;
        width: 250px !important;
    }
    .openbtn{
        display:none !important;
    }
    .closebtn{
        display:none !important;
    }
  }

.copy-right-area{
    bottom: 0;
    position: absolute;
    left: 0;
    right: 0;
}
</style>
<section>
<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
$user_id = $_SESSION['USER']['user_id'];

// $this->db->select('photograph,first_name');
// $this->db->join('users');
// $this->db->where('user_id', $user_id);
// here we select every column of the table
// $this->db->where('status_id',5);
// $q = $this->db->get('users_detail');
// $data = $q->result_array();
$this->db->select('users.first_name,users_detail.photograph');
$this->db->from('users');
$this->db->where('users.user_id ', $user_id);
//  $this->db->where('users_detail.status_id',5); 
$this->db->join('users_detail', 'users_detail.user_id = users.user_id','left');




$query = $this->db->get();
$data = $query->result_array();


?>
<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <div class="profile_image">
                <div style="display:flex; justify-content:center; height:95px;">
                <?php if(!empty($data[0]['photograph'])){?>
                <img src="<?php echo base_url('uploads/photograph/'.$data[0]['photograph']); ?>" style="border-radius:100px; max-width: 95px; width: 100%; object-fit:cover;" >
               <?php  }else{ ?>
                <img src="<?php echo base_url('uploads/photograph/download.jpg'); ?>" style="border-radius:100px; max-width: 95px;" >
              <?php } ?>
                </div>
                
                <h4 style="color:white; text-align:center;"><?php echo ucfirst($data[0]['first_name']); ?></h4>

            </div>
            <div class="d-flex p30">
            <i class="fa fa-regular fa-user" style="color:white;"></i>
            <a href=<?php echo base_url() . "dashboard/UserDashboard"; ?>>Profile</a>
            </div>

            <hr>
            <div class="d-flex p30">
            <i class="fa fa-solid fa-desktop" style="color:white;"></i>
                <a href="<?php echo base_url() . "user/Dashboard"; ?>">Dashboard</a>
            </div>
            <hr>
            <div class="d-flex p30">
            <i class="fa fa-solid fa-book" style="color:white;"></i>
                <a href="<?php echo base_url() . "user/user_manual"; ?>">User Manual</a>
            </div>
            <hr>
            <div class="d-flex p30">
            <i class="fa fa-solid fa-arrow-right" style="color:white;"></i>
                <a target="_blank" href="<?php echo base_url() . "Dashboard/admit_card"; ?>">Admit Card</a>
            </div>
            <hr>
            <div class="d-flex p30">
            <i class="fa fa-solid fa-question" style="color:white;"></i>
                <a target="_blank" href="<?php echo base_url() . "user/help"; ?>">Help</a>
            </div>
            <hr>
            <div class="d-flex p30">
            <i class="fa fa-solid fa-lock" style="color:white;"></i>
                <a href=<?php echo base_url() . "user/ChangePassword"; ?>>Change Password</a>
            </div>
           
            <hr>
            <div class="d-flex p30">
            <i class="fa fa-solid fa-power-off"  style="color:white;"></i>
                <a href=<?php echo base_url() . "user/logout"; ?>>Logout</a>
            </div>
</div>
</section>

<script>
            function openNav() {
              document.getElementById("mySidebar").style.width = "250px";
            }
            
            function closeNav() {
              document.getElementById("mySidebar").style.width = "0";
            }
            </script>