<?php //get_instance()->load->helper('define_helper');
$admin_detail = get_admin_detail($_SESSION['ADMIN']['admin_id']);
$inactive = 1200;
if(isset($_SESSION['timeout']) ) 
{
	
    $session_life = time() - $_SESSION['timeout'];
    if($session_life > $inactive)
    {
        header("Location:".site_url('/logout'));
    }
}
$_SESSION['timeout'] = time();

?>
<script type="text/javascript">
function hearbeat() {
 
 // Creating Our XMLHttpRequest object
 let xhr = new XMLHttpRequest();

 // Making our connection 
 var url = '/nihfw_recruitment/admin/welcome/hearbeat';
 xhr.open("GET", url, true);

 // function execute after request is successful
 xhr.onreadystatechange = function () {
     if (this.readyState == 4 && this.status == 200) {
         console.log(this.responseText);
     }
 }
 // Sending our request
 xhr.send();
}
setInterval(hearbeat, 30000);

</script>
<div id="wrapper">
  <div id="sidebar-wrapper" class="bg-theme bg-theme8" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo" style="background-color: #78b950;">
      <a href="<?php echo base_url('admin/welcome'); ?>">
        <h5 class="logo-text">NIHFW Recruitment</h5>
      </a>
    </div>
    <ul class="sidebar-menu do-nicescrol side_color">
      <!-- <li class="sidebar-header">MAIN NAVIGATION</li> -->
      <!-- <li><a href="<?php //echo base_url('admin/welcome'); ?>" class="waves-effect"><i class="zmdi zmdi-view-welcome"></i> <span>Welcome</span></a></li> -->
      <li><a href="<?php echo base_url('admin/dashboard'); ?>" class="waves-effect"><i class="zmdi zmdi-view-welcome"></i> <span>Dashboard</span></a></li>

      <?php if (has_admin_permission('VIEW_USER') || has_admin_permission('ADD_USER') || has_admin_permission('ADD_USER')) { ?>
        <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-map"></i> <span>User Management</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="sidebar-submenu">

            <?php if (has_admin_permission('VIEW_USER')) { ?>
              <li><a href="<?php echo base_url('admin/user'); ?>"><i class="zmdi zmdi-long-arrow-right"></i> <span>View User</span></a></li>
            <?php } ?>

            <?php if (has_admin_permission('ADD_USER')) { ?>
              <li><a href="<?php echo base_url('admin/user/add_edit_user'); ?>">
                  <i class="zmdi zmdi-long-arrow-right"></i> <span>Add User</span></a></li>
            <?php } ?>

            <?php if (has_admin_permission('VIEW_ROLES')) { ?>
              <li><a href="<?php echo base_url('admin/user/roles'); ?>"><i class="zmdi zmdi-long-arrow-right"></i> <span>Manage Roles</span></a></li>
            <?php } ?>
            <?php if (has_admin_permission('SETTING_DEPARTMENT')) { ?>
              <li><a href="<?php echo base_url('admin/department'); ?>"><i class="zmdi zmdi-long-arrow-right"></i> <span>Manage Department</span></a></li>
            <?php } ?>

            <?php if (has_admin_permission('SETTING_DESIGNATION')) { ?>
              <li><a href="<?php echo base_url('admin/designation'); ?>">
                  <i class="zmdi zmdi-long-arrow-right"></i> <span>Manage Designation</span></a></li>
            <?php } ?>
          </ul>

        </li>
      <?php } ?>
      <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-map"></i> <span>Application Configuration</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="sidebar-submenu">

            <?php if (has_admin_permission('CATEGORY')) { ?>
              <li><a href="<?php echo base_url('admin/category'); ?>"><i class="zmdi zmdi-long-arrow-right"></i> <span>Manage Category</span></a></li>
            <?php } ?>

            <!-- <?php //if (has_admin_permission('SUBCATEGORY')) { ?>
              <li><a href="<?php //echo base_url('admin/Subcategory'); ?>">
                  <i class="zmdi zmdi-long-arrow-right"></i> <span>Subcategory</span></a></li>
            <?php //} ?> -->
            <?php if (has_admin_permission('GROUPS')) { ?>
              <li><a href="<?php echo base_url('admin/Groups'); ?>">
                  <i class="zmdi zmdi-long-arrow-right"></i> <span>Manage Groups</span></a></li>
            <?php } ?>
            <?php if (has_admin_permission('AGE_RELAXATION')) { ?>
              <li><a href="<?php echo base_url('admin/Agerelaxation'); ?>"><i class="zmdi zmdi-long-arrow-right"></i> <span>Manage Age Relaxation</span></a></li>
            <?php } ?>
            <?php if (has_admin_permission('MANAGE_FEE')) { ?>
              <li><a href="<?php echo base_url('admin/managefee'); ?>"><i class="zmdi zmdi-long-arrow-right"></i> <span>Manage Fee</span></a></li>
            <?php } ?>
            
          
          </ul>

        </li>

        <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-map"></i> <span>Manage Advertisement And Post</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="sidebar-submenu">
            <?php if (has_admin_permission('ADVERTISEMENT')) { ?>
              <li><a href="<?php echo base_url('admin/Advertisement'); ?>"><i class="zmdi zmdi-map"></i> <span>ADVERTISEMENT</span></a></li>
            <?php } ?>

            <?php if (has_admin_permission('JOB_POST')) { ?>
              <li><a href="<?php echo base_url('admin/JobPost'); ?>">
                  <i class="zmdi zmdi-map"></i> <span>POST</span></a></li>
            <?php } ?>

            </ul>
        </li> 

        <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-map"></i> <span>Application Verification</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="sidebar-submenu">
        <li><a href="<?php echo base_url('admin/Participants'); ?>" class="waves-effect">
            <i class="zmdi zmdi-map"></i> <span>Application List</span></a></li>
        <li><a href="#" class="waves-effect">
            <i class="zmdi zmdi-map"></i> <span>Application Status Upload</span></a></li>
     
          </ul>

            </li>
      <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-map"></i> <span>Upload Payment Status</span> </a>

      <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-map"></i> <span>Upload Admit Card</span> </a>

      <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-map"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="sidebar-submenu">
        <li><a href="#" class="waves-effect">
            <i class="zmdi zmdi-map"></i> <span>Registered Candidate</span></a></li>
     
          </ul>

        </li>
    </ul>

  </div>
