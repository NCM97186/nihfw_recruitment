<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php
            if (isset($page_title)) {
                echo $page_title . ' :: ';
            }
            ?>NIHFW</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/images/favicon.ico'); ?>">
    <!-- Main Menu CSS -->

    <link href="<?= base_url('assets/css/meanmenu.min.css'); ?>" rel="stylesheet">
    <!-- Normalize CSS -->
    <link href="<?= base_url('assets/css/normalize.css'); ?>" rel="stylesheet">
    <!-- Main CSS -->
    <link href="<?= base_url('assets/css/main.css'); ?>" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font-awesome CSS-->
    <link href="<?= base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- Animate CSS -->
    <link href="<?= base_url('assets/css/animate.min.css'); ?>" rel="stylesheet">
    <!-- Font-flat CSS-->
    <link href="<?= base_url('assets/fonts/flaticon.css'); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css?v=1.0.3'); ?>" rel="stylesheet">
    <!-- gallery CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/gallery.css'); ?>">
    <!-- jquery-->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>


    <base href="<?php echo base_url(); ?>">
    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</head>

<body>

    <div class="wraper">

        <header>
            <div class="header-top-section"></div>
            <div class="header1-area header-two">
                <div class="header-top-area header-top-20" id="sticker">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                                <div class="logo-area">
                                    <a href="<?= base_url(''); ?>">
                                        <img src="<?= base_url('assets/img/logo-nihfw-1.jpg'); ?>" alt="logo" class="img-responsive">
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="text-center">
                                    <img src="<?= base_url('assets/img/logo-new-1.jpg'); ?>" alt="logo" class="img-responsive" style="display: inline;">
                                </div>
								
                            </div>
                               
                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                                <div class="logo_img_top">
                                    <a href="https://mohfw.gov.in/" target="_">
                                        <img src="<?= base_url('assets/img/ministry_logo.png'); ?>" alt="logo" class="img-responsive logo2">
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                                    

            <!--<div class="header1-area header-two">
                    <div class="header-top-area header-top-color" id="sticker">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="main-menu">
                                        <nav>
                                            <ul>
                                                <li><a href="<?= base_url(''); ?>">Home</a></li>
                                                <li><a href="<?= base_url('AboutUs'); ?>">ABOUT US </a></li>
                                                <li><a href="<?= base_url('Events'); ?>">Events</a></li>
                                                
                                                <li><a href="<?= base_url('ContactUs'); ?>">Contact Us</a></li>
                                               
                                                <li class="login_li pull-right" >
                                                    <?php if (!isset($_SESSION['USER']['user_id'])) { ?>
                                                      <a class="fontResizer_minus login_class" href="<?php echo base_url('user/login'); ?>">Login 
                                                            <img src="<?= base_url('assets/img/login_icon.png'); ?>" alt="">
                                                        </a>
                                                    <?php } else { ?>
                                                            <a href="<?php echo base_url('user/logout'); ?>" >Logout </a>
                                                    <?php } ?>

                                                        
                                                </li>
                                               
                                                
                                            </ul>


                                        </nav>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                 mobile-menu-area start 
                <div class="mobile-menu-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mobile-menu">
                                    <nav id="dropdown">

                                            <a class="fontResizer_minus login_class_res" onclick="location.href = '<?php echo base_url('login'); ?>'";>Login 

                                            </a>

                                            <a class="fontResizer_minus login_class_res" 
                                               href="<?php echo base_url('admin/welcome'); ?>" >My Account 

                                            </a>

                                        <ul>
                                            <li><a href="<?= base_url(''); ?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                                            <li><a href="<?= base_url('AboutUs'); ?>">ABOUT US </a></li>
                                            
                                            <li><a href="<?= base_url('ContactUs'); ?>">Contact Us</a></li> 
                                            <li class=" pull-right"><a class="fontResizer_minus login_class_socal" href="https://twitter.com/Vaccinate4Life?ref_src=twsrc%5Etfw"><img src="<?php echo base_url('assets/img/tweet.png'); ?>" alt="" /></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <!-- mobile-menu-area end -->

        </header>