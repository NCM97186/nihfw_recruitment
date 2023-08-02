
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('common/messages.php'); ?>

        <div class="row ">
            <div class="col-lg-12">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <i class="fa fa-table"></i> Manage Fee
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="<?php echo base_url('admin/Managefee/edit'); ?>" class="editLink btn btn-success btn-sm ">+ Add</a>
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
                                            <th>Category</th>
                                            <th>Category Type</th>
                                            <th>Group</th>
                                            <th>Fee</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 1;                                                                              
                                        foreach ($ddata  as $val) {   ?>

                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $val->category ?></td>
                                                <td><?php if($val->category_type == 1){
                                                    echo "Reserved";
                                                }else{
                                                        echo "Unreserved";
                                                    }
                                                 ?></td>
                                                <td><?php echo $val->name ?></td>
                                                <td><?php echo $val->fee ?></td>
                                                <td>
                                                    <a  href="<?php echo site_url('admin/Managefee/edit/' . $val->fee_id) ?>" class=" btn btn-primary btn-sm editLink"><i class="fa fa-pencil"></i></a>
                                                    &nbsp;&nbsp;
                                                    <a href="<?php echo site_url('admin/Managefee/delete/' . $val->fee_id); ?>" class="btn btn-danger btn-sm deleteLink" onclick="return confirm('Are you sure you want to delete Fee')"><i class="fa fa-trash-o"></i></a>
                                                </td>
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

