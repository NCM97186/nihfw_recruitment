<?php $this->load->view('common/messages.php'); ?>
<div class="contact-page-area padding-bottom">
    <div class="container-fluid">
        <div id="national_form" style="text-align: center">
            <div class="panel panel-info national_form_border">
                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%">
                        <table class="table table-bordered" id="tbl_Candidate">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-left"></td>
                                </tr>
                                <tr class="bg-info">
                                    <td colspan="2" class="heading2" align="center">
                                        <span>*** All Notifications/Advertisements Details ***</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="heading2" align="center"></td>
                                </tr>


                                <tr style="font-size: 12pt">
                                    <td colspan="2" style="text-align: left">
                                        <div style="text-align: left">
                                            <table id="dynamic_field" class="table table-bordered" style="width: 100%">
                                                <tbody>
                                                    <tr class="bg-danger">
                                                        <td align="left" style="font-weight: bold; color: white;" valign="top">Sr.No.</td>
                                                        <td align="left" style="font-weight: bold; color: white;" valign="top">Examination Name</td>
                                                        <td align="left" style="font-weight: bold; color: white;" valign="top">Advt. Number , Date</td>
                                                        <td align="left" style="font-weight: bold; color: white;" valign="top">Start Date</td>
                                                        
                                                        <td align="left" style="font-weight: bold; color: white;" valign="top">Form Submission Last Date</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <?php $i=1; 
                                                    /*echo "<pre>";
                                                    print_r($result);*/
                                                    foreach ($result as $results) { ?>


                                                    <tr>
                                                        <td align="left">
                                                            <strong><?php echo $i++."."; ?></strong>
                                                        </td>
                                                        <td align="left"><?php echo $results->post_name; ?></td>
                                                        <td align="left"><?php echo $results->adver_no.",".$results->adver_date; ?></td>
                                                        <td align="left"><?php echo $results->start_date; ?></td>
                                                        <td align="left"><?php echo $results->last_date; ?></td>
                                                        
                                                        <td align="left">
                                                            <?php if($results->link_to_pdf!='pending'){?>
                                                                <a class="btn btn-info" href="<?php echo $results->link_to_pdf; ?>" target="_New">View Advertisement</a>
                                                            <?php } ?>
                                                        </td>
                                                        
                                                        <td align="left">
                                                         <?php if(isset($_SESSION['USER']['user_id'])){?>
                                                            <a class="btn btn-success" href="<?php echo base_url('dashboard') ?>">Apply</a>
                                                        <?php } else{ ?>
                                                             <a class="btn btn-success" href="<?php echo base_url('user/login') ?>">Apply</a>
                                                        <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php  } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main body End Here -->
    </div>
</div>

<script>
    $(document).ready(function() {
        var i = 5;
        $('#add').click(function() {
            b = i++;
            $('#dynamic_field').append('<tr id="row' + b + '"><td><strong>' + b + '.</strong></td><td><input type="text" class="form-control" /></td><td><input type="text" class="form-control" /></td><td><input type="text" class="form-control" /></td><td><input type="text" class="form-control" /></td><td><input type="text" class="form-control" style="width:80%; float:left"/> <button type="button" name="remove" id="' + b + '" class="btn btn-danger btn_remove" style="width:16%;  float:right">X</button></td></tr>');
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
    });
</script>
