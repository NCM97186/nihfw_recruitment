<div class="contact-page-area container-fluid padding-bottom">
     <?php $this->load->view('common/user_tab.php');  ?>
    <div class="container">
        <div id="national_form" class="container" style="text-align: center">

            <div class="panel panel-info national_form_border">

                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%">

                        
                            <?php 
                                 $attributes = array('name' => 'photo_signature');
                                 $action =   base_url()."dashboard/photo_signature/";
                                  echo form_open_multipart($action, $attributes);
                                  if(isset($photo_signature->id)){
                                    $photoId = $photo_signature->id;
                                  }else{
                                    $photoId = '';
                                  }
                                ?>
                            <table class="table table-bordered" id="tbl_Candidate">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align: left; width: 100%;">
                                            <table align="left" class="table table-bordered" style="width: 100%" id="tblcndt">
                                                <tbody>
                                                    <tr>
                                                        <td align="left" colspan="3">
                                                            <p style="font-size: 13px;line-height: 15px;color: #4c4cb7;">NOTE: A recent, CLEARLY recognizable passport size photograph (4.5cm x 3.5cm) should be uploaded by the cendidate in the online application from and the signature uploaded should be clear and legible. Candidates are also abvised not to change treir appearance till the process is completed. Any doubt about photograph or signature at any stage of the process could lead to disqualification.</p>
                                                        </td>


                                                    </tr>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span >Scanned Photograph of the Candidate:</span><span style="font-size: medium; color: #CC0000"></span>
                                                        </td>
                                                        <td align="left" style="width: 40%;">
                                                            <input type="hidden" name="userid" value="<?php echo $photoId ?>">
                                                            <input name="photograph" type="file" title="Please upload your Signature" class="CapLetter form-control" value="<?php echo set_value("photograph"); ?>" accept="image/jpeg,image/gif,image/png,image/jpg">

                                                            <em>
                                                                <span class="form_error"><?php echo form_error('photograph'); ?></span>
                                                            </em>
                                                            <br />
                                                            <em>Photo should be clearly visible in the adjacent box</em>
                                                        </td>
                                                        <td align="center" style="width: 30%;">
                                                            <?php if(isset($photo_signature->photograph)){?>
                                                           <input type="hidden" name="old_photo" value="<?php echo $photo_signature->photograph; ?>">
                                                           <img src="<?php  echo base_url('uploads/photo/' . $photo_signature->photograph);  ?>" class="img-responsive" target="_blank" width="80" height="50">
                                                        <?php } ?>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span >Scanned Signature of the Candidate </span><span style="font-size: medium; color: #CC0000"></span>
                                                        </td>
                                                        <td align="left" style="width: 40%;">
                                                        <input name="signature" type="file" title="Please upload your Signature" class="CapLetter form-control" value="<?php echo set_value("signature", @$photo_signature->signature); ?>" accept="image/jpeg,image/gif,image/png,image/jpg">
                                                        <span class="form_error"><?php echo form_error('signature'); ?></span>
                                                            <br />
                                                            <em>Signature should not be CAPITAL/BLOCK letters</em>
                                                        </td>
                                                         <td align="center" style="width: 30%;">
                                                            <?php if(isset($photo_signature->signature)){?>
                                                           <input type="hidden" name="old_sign" value="<?php echo $photo_signature->signature; ?>">
                                                           <img src="<?php  echo base_url('uploads/sign/' . $photo_signature->signature);  ?>" class="img-responsive" target="_blank" width="80" height="50">
                                                        <?php } ?>
                                                        </td>
                                                    </tr>




                                                </tbody>
                                            </table>


                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered" id="Table1">
                                <tbody>
                                    <tr class="bg-info">
                                        <td style="text-align: left;">
                                            <a href="<?php echo base_url('dashboard/basicinfo')?>"  class="btn btn-success" style="font-weight:bold;width:100px;">Back</a>
                                        </td>
                                        <td style="text-align: right;">
                                            <input type="submit" name="photo_sign" value="Next" class="btn btn-success" style="font-weight:bold;width:100px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                    </div>
                </div>

            </div>
        </div>
        <!-- Main body End Here -->
    </div>
</div>