<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('common/messages.php'); ?>

        <div class="row ">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i>  Import Payment Status </div>
                    <div class="card-body">

                        <form enctype="multipart/form-data" method="post" action="<?php echo site_url('admin/Payment/import/') ?>">
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
                                <div class="form-group row">
                                    <label class="col-md-3" style="margin-top:10px; text-align: center;">Import CSV <font color="red">*</font></label>
                                   
                                        <div class="col-md-8">
                                        <p> <a href="<?php echo base_url('/uploads/sample/payment_data.csv'); ?>" >Download Sample</a> </p>  
                                        <p style="color:red" >Please don't change header also don't change order of header </p>
                                        <input type="File" name="paymentstatus" id="paymentstatus" required class="form-control error">
                                        <span class="form_error"><?php echo form_error('paymentstatus'); ?></span>
                                    </div>
                                </div>
                
                                <div id="dvCSV" class="table-responsive table-basic1" style="overflow-x:auto;"></div>
                               <hr/>
                                    <div class="text-center">
                                        <button type="submit" value="upload" name="upload" id="srch" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i> Upload</button>
                                        <!--button type="submit" value="confirm" name="confirm" id="confirm" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i> Confirm</button-->
                                        <a  href="<?php echo site_url('admin/paymentstatus/') ?>" type="reset" id="srchqq" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
                                    </div>

                            </div>
                        </form>
                      
                           
                        
                    </div>
                </div>
            
                </div>
              
            </div>
        </div><!-- End Row-->


    </div>
    <!-- End container-fluid-->
</div>
<script type="text/javascript">
  

    $("#paymentstatus").change(function(e) {
        var ext = $("input#paymentstatus").val().split(".").pop().toLowerCase();
        if($.inArray(ext, ["csv"]) == -1) {
        alert('Upload CSV');
        return false;
        } 
        if (e.target.files != undefined) {
            var table = $("<table  class='table' />");
        var reader = new FileReader();
        reader.onload = function(e) {
            var table = $("<table  class='table' />");
                        var rows = e.target.result.split("\n");
                        for (var i = 0; i < rows.length; i++) {
                            var row = $("<tr />");
                            var cells = rows[i].split(",");
                            if (cells.length > 1) {
                                for (var j = 0; j < cells.length; j++) {
                                    var cell = $("<td />");
                                    cell.html(cells[j]);
                                    row.append(cell);
                                }
                                table.append(row);
                            }
                        }
                        $("#dvCSV").html('');
                        $("#dvCSV").append(table);
        };
       
        reader.readAsText(e.target.files.item(0));
        }
        return false;
    });
</script>