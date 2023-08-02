<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css"
        integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 2px solid #545454;
  text-align: left;
  padding: 8px;
}

/* tr:nth-child(even) {
  background-color: #dddddd;
} */
</style>
<body>
    <header>
        <!-- <div style="height: 5px; background-color: orange;"></div>
        <div class="header1-area header-two">
            <div class="header-top-area header-top-20" id="sticker">
                <div class="container-fluid">
                    <div class="row" style="justify-content: space-between;">
                        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                            <div class="logo-area">
                                <a href="#">
                                    <img src="logo-nihfw-1.jpg" alt="logo" class="img-responsive ">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="text-center">
                                <img src="logo-new-1.jpg" alt="logo" class="img-responsive w-50" style="display: inline;">
                            </div>
                            
                        </div>
                           
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                            <div class="logo_img_top">
                                <a href="https://mohfw.gov.in/" target="_">
                                    <img src="ministry_logo.png" alt="logo" class="img-responsive logo2">
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> -->
                 <div style="display: flex; justify-content: center; margin: 0px 0 10px 0;">
                    <img src="<?= base_url('assets/img/logo-nihfw-1.jpg'); ?>" alt="logo" style="margin:20px">
                    <img src="<?= base_url('assets/img/logo-new-1.jpg'); ?>" alt="logo" style="margin:20px; max-width: 43%; height: auto;">
                    <img src="<?= base_url('assets/img/ministry_logo.png'); ?>" alt="logo" style="margin:20px;">
                 </div>               

    </header>
<section>
    <table class="container">
        <tr>
            <th style="width: 18%; font-size:15px;">Applied Post</th>
            <td colspan="3" style="font-size:16px; font-weight: bold; text-align: center;">Business Analyst</td>
            <td style="width: 10%;" rowspan="5"><img style="max-width: 130px;" src="<?php echo base_url('uploads/photograph/Vasudev.jpeg'); ?>" alt=""></td>
        </tr>
        <tr>
            <td style="width: 18%; font-size:15px;">Roll Number</td>
            <td colspan="3" style="font-size:16px; font-weight: bold; text-align: center;">11810318264</td>
        </tr>
        <tr>
            <td style="width: 18%; font-size:15px;">Name</td>
            <td colspan="3" style="font-size:16px; font-weight: bold; text-align: center;">Vasudev Aggarwal</td>
        </tr>
        <tr>
            <td style="width: 18%; font-size:15px;">Father's Name</td>
            <td colspan="3" style="font-size:16px; font-weight: bold; text-align: center;">Raj Kumar Aggarwal</td>
        </tr>
        <tr>
            <td style="width: 18%;">Category</td>
            <td style="font-weight: bold; text-align: center; font-size:15px;">General</td>
            <td colspan="2" style="text-align: center; font-size:15px;">Ex-Servicemen: <span style="font-weight: bold;">No</span></td>
            <!-- <td style="text-align: center; font-size:15px;">DOB : <span style="font-weight: bold;">25-04-1997</span></td> -->
        </tr>
        <tr>
            <td style="width: 20%;">DOB</td>
            <td style="font-weight: bold; text-align: center; font-size:15px;">21-12-1999</td>
            <td  style="text-align: center; font-size:15px;">Gender: <span style="font-weight: bold;">Male</span></td>
            <td  style="text-align: center; font-size:15px;">PWBD: <span style="font-weight: bold;">No</span></td>
            <td  rowspan="2"><img style="max-width: 100px;" src="<?php echo base_url('uploads/photograph/signature-sample.png'); ?>" alt="<?php echo base_url('uploads/photograph/pp.png'); ?>""></td>
        </tr>
        <tr>
            <td colspan="4" style="text-align: center; font-size:15px;">Date and Time of Reporting at Venue : <span style="font-weight: bold;">13-07-2023 & 10:00 AM</span></td>
             </tr>
        <tr>
            <td colspan="5" style="text-align: center; font-size:15px;">Name & Address of Venue : <span style="font-weight: bold;">B-214 Okhla Phase 1 Industrial Area New Delhi 110020</span></td>
        </tr>
        
    </table>
</section>
<section>
    <h4 style="text-align: center; margin-top: 30px; text-decoration: underline;">Important Instruction to the Candidate</h4>
    <div style="display: flex; justify-content: center;">
        <ol>
            <li style="font-size: 16px; line-height: 22px;">Be present at the venue at least 30 Minutes before start of test</li>
            <li style="font-size: 16px; line-height: 22px;">Candidate must bring a copy of downloaded original acknowledgement, admit card (in duplicate) and one identityproof i.e. Driving licence, voter card, aadhar card, PAN card, Pass port to deposit with documentation board of SSBat the time of documentation. Failing which the candidate will be rejected in documentation</li>
            <li style="font-size: 16px; line-height: 22px;">Candidate should bring all original Certificate(s)/Testimonials and self attested photostate copies of documents andthree passport photographs at the time of PET & PST</li>
            <li style="font-size: 16px; line-height: 22px;">Ex-Servicemen should bring the Discharge/Release Certificate.</li>
            <li style="font-size: 16px; line-height: 22px;">You may have to stay for 2-3 days for PET, PST and other test and therefore come prepared accordingly</li>
            <li style="font-size: 16px; line-height: 22px;">SSB will not be responsible for any injury/damage/death caused, if any during the recruitment process</li>
            <li style="font-size: 16px; line-height: 22px;">The competent authority has full rights to make changes or cancel the recruitment or postpone the recruitmentwithout assigning any reason</li>
            <li style="font-size: 16px; line-height: 22px;">Canvassing in any form or bringing outside influence, pressure, offering illegal gratification, blackmailing,threatening to blackmail will lead to disqualification the candidate</li>
            <li style="font-size: 16px; line-height: 22px;">Candidates impersonating and submitting fabricated documents are also liable to be disqualified and subject tolegal action as per law of land</li>
          </ol>
    </div>
</section>
</body>
</html>