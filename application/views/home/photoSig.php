<div class="contact-page-area container-fluid padding-bottom">
    <div class="tabbable">
        <ul class="nav nav-tabs wizard">
            <li><a href="<?php echo base_url('basic_info') ?>"><span class="nmbr">1</span>Basic Info</a></li>
            <li class="active"><a href="<?php echo base_url('Photo_sig') ?>"><span class="nmbr">2</span>Photo & Signature</a></li>
            <li><a href="<?php echo base_url('Details') ?>"><span class="nmbr">3</span>Details</a></li>
            <li><a href="#companydoc" data-toggle="tab" aria-expanded="false"><span class="nmbr">4</span>Preview</a></li>
            <li><a href="#upload" data-toggle="tab" aria-expanded="true"><span class="nmbr">5</span>Uploads</a></li>
            <li><a href="#payment" data-toggle="tab" aria-expanded="true"><span class="nmbr">5</span>Payment</a></li>

        </ul>
    </div>
    <div class="container">
        <div id="national_form" class="container" style="text-align: center">

            <div class="panel panel-info national_form_border">

                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%">

                        <form method="post" id="notification-form" action="" enctype="multipart/form-data">
                            <table class="table table-bordered" id="tbl_Candidate">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="text-align: left; width: 100%;">
                                            <table align="left" class="table table-bordered" style="width: 100%" id="tblcndt">
                                                <tbody>
                                                    <tr>
                                                        <td align="left" colspan="2">
                                                            <p style="font-size: 13px;line-height: 15px;color: #4c4cb7;">NOTE: A recent, CLEARLY recognizable passport size photograph (4.5cm x 3.5cm) should be uploaded by the cendidate in the online application from and the signature uploaded should be clear and legible. Candidates are also abvised not to change treir appearance till the process is completed. Any doubt about photograph or signature at any stage of the process could lead to disqualification.</p>
                                                        </td>


                                                    </tr>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">

                                                            <span id="">Scanned Photograph of the Candidate:</span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="signature" type="file" title="Please upload your Signature" class="CapLetter form-control" value="">
                                                            <br />
                                                            <em>Photo should be clearly visible in the adjacent box

                                                            </em>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Scanned Signature of the Candidate </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                        <input name="signature" type="file" title="Please upload your Signature" class="CapLetter form-control" value="">
                                                            <br />
                                                            <em>Signature should not be CAPITAL/BLOCK letters</em>
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
                                            <a href="" name="" class="btn btn-success" style="font-weight:bold;width:100px;">Back</a>
                                        </td>
                                        <td style="text-align: right;">
                                            <input type="submit" name="" value="Next" onclick="" id="" class="btn btn-success" style="font-weight:bold;width:100px;">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/additional-methods.js"></script>