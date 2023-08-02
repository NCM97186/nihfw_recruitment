
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('common/messages.php'); ?>

        <div class="row ">
            <div class="col-lg-12">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <i class="fa fa-table"></i> Advertisement
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="<?php echo base_url('admin/Advertisement/edit'); ?>" class="editLink btn btn-success btn-sm ">+ Add</a>
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
                                            <th>Advertisement No</th>
                                            <th>Advertisement Title</th>
                                            <th>View Advertisement</th>
                                            <th>Advertisement Date</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        
                                        
                                        $i = 1;
                                        foreach ($ddata  as $val) {   
                                            $Date = date("d-m-Y", strtotime($val->adver_date));
                                            ?>

                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $val->adver_no	 ?></td>
                                                <td><?php echo $val->adver_title ?></td>
                                                <td style="word-break: break-all;">
														<?php if(!empty($val->link_to_pdf)){?>
															<a href="<?= base_url('uploads/link_to_pdf/').@$val->link_to_pdf; ?>" target="_blank" class="btn btn-info">View</a>
														<?php }?></td>
                                                <td><?php echo $Date?></td>
                                                <!-- <td style="display: flex;">
                                                    <a  href="<?php //echo site_url('admin/Advertisement/edit/' . $val->adver_id) ?>" class=" btn btn-primary btn-sm editLink"><i class="fa fa-pencil"></i></a>
                                                    &nbsp;&nbsp;
                                                    <a href="<?php //echo site_url('admin/Advertisement/delete/' . $val->adver_id); ?>" class="btn btn-danger btn-sm deleteLink" onclick="return confirm('Are you sure you want to delete Advertisement')"><i class="fa fa-trash-o"></i></a>
                                                </td> -->
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
