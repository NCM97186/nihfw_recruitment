 <?php 

$admin_detail = get_admin_detail($_SESSION['ADMIN']['admin_id']);
//print_r($admin_detail);

?>
<header class="topbar-nav">
            <nav class="navbar navbar-expand fixed-top">
                <ul class="navbar-nav mr-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link toggle-menu" href="javascript:void();">
                            <i class="icon-menu menu-icon"></i>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center right-nav-link">
                   
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                            <span class="user-profile"><img src="<?= base_url('assets/img/md.png'); ?>" class="img-circle" alt="user avatar"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item user-details">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <div class="avatar"><img class="align-self-start mr-3" src="<?= base_url('assets/img/md.png'); ?>" alt="user avatar"></div>
                                        <div class="media-body">
                                            <h6 class="mt-2 user-title">
                                                Username: <?php echo $admin_detail['username'];?> </h6>
                                            <p class="user-subtitle">
                                             Role: <?php echo $admin_detail['role_name'];?></p>

                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                            <a href="<?php echo base_url('admin/welcome'); ?>"><i class="icon-user mr-2"></i>Profile</a></li>
                            <li class="dropdown-item">
                            <a href="<?= base_url('admin/Dashboard/change_pass'); ?>"><i class="icon-lock mr-2"></i>Change Password</a></li>
                            <li class="dropdown-item">
							<a href="<?= base_url('Logout'); ?>"><i class="icon-power mr-2"></i> Logout</a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </header>

<div class="clearfix"></div>