
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('common/messages.php'); ?>

        <div class="row ">
            <div class="col-lg-12">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <i class="fa fa-table"></i> Registered Candidates
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
                                            <th>Registration Number</th>
                                            <th>Full Name</th>
                                            <th>E-mail</th>
                                            <th>Mobile Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                         <?php
                                        $i = 1;                                                                              
                                       foreach ($ddata  as $val) {   ?>

                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $val->registration_number;?></td>
                                                <td><?php echo $val->first_name." ".$val->middel_name." ".$val->last_name; ?></td>
                                                <td><?php echo $val->cand_email ?></td>
                                                <td><?php echo $val->cand_mob ?></td>
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

