
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('common/messages.php'); ?>

        <div class="row ">
            <div class="col-lg-12">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <i class="fa fa-table"></i> POST
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="<?php echo base_url('admin/JobPost/edit'); ?>" class="editLink btn btn-success btn-sm ">+ Add</a>
                        </div>
                    </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive table-basic">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Post Name</th>
                                            <th>Group</th>
                                            <th>Start Date</th>
                                            <th>Last Date</th>
                                            <th>Min Age</th>
                                            <th>Max Age</th>
                                            <th>Post Status</th>
                                            <th>Advertisement Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        foreach ($ddata  as $val) { 
                                            $start_date = date("d-m-Y", strtotime($val->start_date));
                                            $last_date = date("d-m-Y", strtotime($val->last_date));
                                            $min_age_date = date("d-m-Y", strtotime($val->min_age_date));
                                            $max_age_date = date("d-m-Y", strtotime($val->max_age_date));
                                              ?>

                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $val->post_name	 ?></td>
                                                 <td><?php if($val->group_id == 1){
                                                    echo "A";
                                                 }	if($val->group_id == 2){
                                                    echo "B";
                                                 }
                                                 if($val->group_id == 3){
                                                    echo "C";
                                                 } ?></td>
                                                <td><?php echo $start_date ?></td>
                                                <td><?php echo $last_date ?></td>
                                                <td><?php echo $min_age_date ?></td>
                                                <td><?php echo $max_age_date ?></td>
                                                <td><?php if($val->post_status==1){
                                                              echo "Enabled";}else{echo "Disabled";} ?></td>
                                                <td><?php echo $val->title ?></td>
                                                <?php //$date = date("Y-m-d");
                                                   // $startdate= date("Y-m-d",strtotime($start_date));
                                                 //if($startdate > $date){ ?>
                                             <td>
                                             <button type="button" class="btn btn-success btn-sm waves-effect waves-light m-1 viewUser" data-toggle="modal" data-target="#largesizemodal" value="<?php echo $val->post_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>

                                             <!-- <a style="margin-bottom:5px"  href="<?php echo site_url('admin/JobPost/view/' . $val->post_id) ?>" class=" btn btn-primary btn-sm editLink"><i class="fa fa-pencil"></i></a> -->
                                                       <a style="margin-bottom:5px"  href="<?php echo site_url('admin/JobPost/edit/' . $val->post_id) ?>" class=" btn btn-primary btn-sm editLink"><i class="fa fa-pencil"></i></a>
                                                       <a href="<?php echo site_url('admin/JobPost/delete/' . $val->post_id); ?>" class="btn btn-danger btn-sm deleteLink" onclick="return confirm('Are you sure you want to delete Job')"><i class="fa fa-trash-o"></i></a>
                                                   </td>
                                                <?php //}
                                                //else{ ?>
                                                       <!-- <td>
                                                        
                                                       </td>                           -->
                                                       
                                             <?php   //} ?>
                                            </tr>

                                        <?php  } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Row-->


        </div>
        <!-- End container-fluid-->



    </div>


      <!-- Modal -->
      <div class="modal fade" id="largesizemodal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Post Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id='model_data_ajax'></div>
				</div>
			</div>
		</div>
        <!-- Modal -->

        <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript">

    $(document).ready(function () {

  
        //$(".getUserId").click(function () {

		 $('body').on('click', '.viewUser',function(e){
		    e.preventDefault();
			console.log('view job');
            var uId = $(this).val();
            var url = "<?php echo base_url() . 'admin/JobPost/view/' ?>"+uId;
            $.ajax({
                type: "POST",
                url: url,
                data: {'layout_type':'popup'},
                success: function (data) {
                    $("#model_data_ajax").html(data);
                },
                 beforeSend: function () {
                    $("#model_data_ajax").html('Please wait...');
                 },
                failure: function (data) {
                    alert('Failure!');
                }
            });

        });

    });

        </script>
