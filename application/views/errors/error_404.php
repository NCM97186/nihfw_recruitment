<?php header('Access-Control-Allow-Origin: *'); ?>
<?php $this->load->view('common/front_header'); ?>
<style>
.asktl{
			background: #1d4978;
			padding: 8px;
			color: #fff;
			font-size: 26px;
			margin-top: 0px;
		}
		
</style>
        
        <div class="clearfix"></div>
        <section>
            <div class="container mt20">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb10">
                        <li><a href="<?php echo site_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                    </ol>
                </nav>
            </div>
        </section>
        <section class="gallery_sec">
            <div class="container wrap-container">
			<div class="tab-content form_bg">
                <div class="row">

                    <div class="col-xs-12 col-sm-12">
                        
                            <div id="photos" class="col-md-12">
                                <div class="nbs-flexisel-container">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12 innerhead">
													<h1 class="asktl"><?php echo $page_title; ?></h1>
												</div>
												<div class="col-md-12">
													<div class="span4" style="min-height: 280px;">
														
															Sorry! <br>
															The requested page could not be found.
															We apologize for the inconvenience, but the page you tried to access does not exist on this location. You have either misspelled the filename or the link you used is out-dated. 

													</div>
												</div>
											</div>
										</div>
									</div>
                                </div>
                            </div>
                       
                    </div>
                    
                </div>
                
				</div>
            </div>
        </section>


<?php $this->load->view('common/front_footer'); ?>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('#main-nav nav').meanmenu()
            });
        </script>
        <script>
            new WOW().init();
        </script>
        <script>
            $('#fromdate,#todate').datepicker({
                format: 'mm/dd/yyyy',
				autoclose: true
            });
        </script>
    </body>
</html>