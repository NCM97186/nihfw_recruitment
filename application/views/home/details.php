<div class="contact-page-area container-fluid padding-bottom">
    <div class="tabbable">
        <ul class="nav nav-tabs wizard">
            <li><a href="<?php echo base_url('basic_info') ?>" data-toggle="tab" aria-expanded="false"><span class="nmbr">1</span>Basic Info</a></li>
            <li><a href="<?php echo base_url('Photo_sig') ?>"><span class="nmbr">2</span>Photo & Signature</a></li>
            <li class="active"><a href="<?php echo base_url('Details') ?>"><span class="nmbr">3</span>Details</a></li>
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

                        <form method="post" id="notification-form" action="https://localhost/www/nihfw_post/home/save" enctype="multipart/form-data" novalidate="novalidate">
                            <table class="table table-bordered" id="tbl_Candidate">
                                <tbody>
                                    <tr class="bg-info">
                                        <td colspan="2" class="heading2">
                                            <span>Basic Details ↓ </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" style="text-align: left; width: 100%;">
                                            <table align="left" class="table table-bordered" style="width: 100%" id="tblcndt">
                                                <tbody>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">

                                                            <span id="">Category</span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> GENERAL
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> EWS
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> OBC
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> ST
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> SC

                                                            <br>
                                                            <span class="form_error"></span>
                                                            </em>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" style="background: #fff; font-size: 13px; color: #6969de;">No change in category will be permitted after final submission of your application.</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Are you a person with benchmark disability of 40% and above? </span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>

                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> Yes
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> No
                                                            <br>
                                                            <em>
                                                                <span class="form_error"></span>
                                                            </em>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>


                                        </td>
                                    </tr>

                                    <tr class="bg-info">
                                        <td colspan="2" class="heading2">
                                            <span>Personal Details ↓ </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" style="text-align: left; width: 100%;">
                                            <table align="left" class="table table-bordered" style="width: 100%" id="tblcndt">
                                                <tbody>
                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Date Of Birth (DD/MM/YYYY) </span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <div class="form-inline">
                                                                <select name="day" id="" value="" title="Please Select Day of DOB" class="form-control" style="width:100px;">
                                                                    <option value="">DAY</option>
                                                                    <option value="1">01 </option>
                                                                    <option value="2">02 </option>
                                                                    <option value="3">03 </option>
                                                                    <option value="4">04 </option>
                                                                    <option value="5">05 </option>
                                                                    <option value="6">06 </option>
                                                                    <option value="7">07 </option>
                                                                    <option value="8">08 </option>
                                                                    <option value="9">09 </option>
                                                                    <option value="10">10 </option>
                                                                    <option value="11">11 </option>
                                                                    <option value="12">12 </option>
                                                                    <option value="13">13 </option>
                                                                    <option value="14">14 </option>
                                                                    <option value="15">15 </option>
                                                                    <option value="16">16 </option>
                                                                    <option value="17">17 </option>
                                                                    <option value="18">18 </option>
                                                                    <option value="19">19 </option>
                                                                    <option value="20">20 </option>
                                                                    <option value="21">21 </option>
                                                                    <option value="22">22 </option>
                                                                    <option value="23">23 </option>
                                                                    <option value="24">24 </option>
                                                                    <option value="25">25 </option>
                                                                    <option value="26">26 </option>
                                                                    <option value="27">27 </option>
                                                                    <option value="28">28 </option>
                                                                    <option value="29">29 </option>
                                                                    <option value="30">30 </option>
                                                                    <option value="31">31 </option>

                                                                </select>
                                                                /&nbsp;<select name="mon" value="" id="" title="Please Select Month of DOB" class="form-control" style="width:100px;">
                                                                    <option value="">MONTH</option>


                                                                    <option value="1">January</option>


                                                                    <option value="2">February</option>


                                                                    <option value="3">March</option>


                                                                    <option value="4">April</option>


                                                                    <option value="5">May</option>


                                                                    <option value="6">June</option>


                                                                    <option value="7">July</option>


                                                                    <option value="8">August</option>


                                                                    <option value="9">September</option>


                                                                    <option value="10">October</option>


                                                                    <option value="11">November</option>


                                                                    <option value="12">December</option>

                                                                </select>

                                                                <select name="year" value="" id="" title="Please Select Year of DOB" class="form-control" style="width:100px;">
                                                                    <option value="">YEAR</option>
                                                                    <option value="1955">1955</option>
                                                                    <option value="1956">1956</option>
                                                                    <option value="1957">1957</option>
                                                                    <option value="1958">1958</option>
                                                                    <option value="1959">1959</option>
                                                                    <option value="1960">1960</option>
                                                                    <option value="1961">1961</option>
                                                                    <option value="1962">1962</option>
                                                                    <option value="1963">1963</option>
                                                                    <option value="1964">1964</option>
                                                                    <option value="1965">1965</option>
                                                                    <option value="1966">1966</option>
                                                                    <option value="1967">1967</option>
                                                                    <option value="1968">1968</option>
                                                                    <option value="1969">1969</option>
                                                                    <option value="1970">1970</option>
                                                                    <option value="1971">1971</option>
                                                                    <option value="1972">1972</option>
                                                                    <option value="1973">1973</option>
                                                                    <option value="1974">1974</option>
                                                                    <option value="1975">1975</option>
                                                                    <option value="1976">1976</option>
                                                                    <option value="1977">1977</option>
                                                                    <option value="1978">1978</option>
                                                                    <option value="1979">1979</option>
                                                                    <option value="1980">1980</option>
                                                                    <option value="1981">1981</option>
                                                                    <option value="1982">1982</option>
                                                                    <option value="1983">1983</option>
                                                                    <option value="1984">1984</option>
                                                                    <option value="1985">1985</option>
                                                                    <option value="1986">1986</option>
                                                                    <option value="1987">1987</option>
                                                                    <option value="1988">1988</option>
                                                                    <option value="1989">1989</option>
                                                                    <option value="1990">1990</option>
                                                                    <option value="1991">1991</option>
                                                                    <option value="1992">1992</option>
                                                                    <option value="1993">1993</option>
                                                                    <option value="1994">1994</option>
                                                                    <option value="1995">1995</option>
                                                                    <option value="1996">1996</option>
                                                                    <option value="1997">1997</option>
                                                                    <option value="1998">1998</option>
                                                                    <option value="1999">1999</option>
                                                                    <option value="2000">2000</option>
                                                                    <option value="2001">2001</option>
                                                                    <option value="2002">2002</option>
                                                                    <option value="2003">2003</option>


                                                                </select>


                                                                <span id="" style="color:Black;font-family:Times New Roman;font-weight:normal;"></span>
                                                                <br>
                                                                <em><span style="color: #7d7e7f">( Please Select your DOB As given in Matriculation Certificate.
                                                                        )</span></em>
                                                                <span id="" class="bg-warning" style="color:Red;display:none;"></span>
                                                                <span id="" class="bg-warning" style="color:Red;display:none;"></span>
                                                                <span id="" class="bg-warning" style="color:Red;display:none;"></span>
                                                                <span class="form_error"></span>
                                                                <span class="form_error"></span>
                                                                <span class="form_error"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" style="background: #fff; font-size: 13px; color: #6969de;">NOTE: Please ensure you have already filled in the details under Basic Details in the Online Form especially pertaining to category. Change in Date of Birth will not be permitted</td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Gender </span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> Male
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> Female
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> Others
                                                        </td>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Marital Status </span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> Unmarrid
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> Married
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> Widow
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> Widower
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> Divorced
                                                            <input name="" type="checkbox" id="" title="" class="" value=""> Judicially Separated
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Father's Name </span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="cand_name" type="text" maxlength="50" id="" title="Please Type Candidate Name, Do not entered Mr./Mrs./Km./Dr./Er. etc. in Prefix of your Name " class="CapLetter form-control" style=" width:70%; display: inline" value=""> (Maximum 35 Characters)
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Mother's Name </span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="cand_name" type="text" maxlength="50" id="" title="" class="CapLetter form-control" style=" width:70%;display: inline" value=""> (Maximum 35 Characters)
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Address for Correspondence</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="cand_name" type="text" id="" title="" class="CapLetter form-control" style=" width:70%;display: inline" value=""> (Maximum 35 Characters)
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Address 1</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="cand_name" type="text" id="" title="" class="CapLetter form-control" style=" width:70%;display: inline" value=""> (Maximum 35 Characters)
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Address 2</span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="cand_name" type="text" id="" title="" class="CapLetter form-control" style=" width:70%;display: inline" value=""> (Maximum 35 Characters)
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Address 3</span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="cand_name" type="text" id="" title="" class="CapLetter form-control" style=" width:70%;display: inline" value=""> (Maximum 35 Characters)
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">District</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="cand_name" type="text" id="" title="" class="CapLetter form-control" style=" width:70%;display: inline" value=""> (Maximum 20 Characters)
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">State</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <select name="cand_name" type="text" id="" title="" class="CapLetter form-control" style=" width:70%;" value="">
                                                                <option>--Select State--</option>
                                                            </select>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Pincode</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 30%;">
                                                            <input name="cand_name" type="text" id="" title="" class="CapLetter form-control" style=" width:30%; display: inline;" value=""> (6 Digits)
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2"><input type="checkbox"> Same as Address for Correspondence (Click if applicable Permanent address)</td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Address 1</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="cand_name" type="text" id="" title="" class="CapLetter form-control" style=" width:70%;display: inline" value=""> (Maximum 35 Characters)
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Address 2</span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="cand_name" type="text" id="" title="" class="CapLetter form-control" style=" width:70%;display: inline" value=""> (Maximum 35 Characters)
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Address 3</span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="cand_name" type="text" id="" title="" class="CapLetter form-control" style=" width:70%;display: inline" value=""> (Maximum 35 Characters)
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">District</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <input name="cand_name" type="text" id="" title="" class="CapLetter form-control" style=" width:70%;display: inline" value=""> (Maximum 20 Characters)
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">State</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 70%;">
                                                            <select name="cand_name" type="text" id="" title="" class="CapLetter form-control" style=" width:70%;" value="">
                                                                <option>--Select State--</option>
                                                            </select>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="right" style="width: 30%;">
                                                            <span id="">Pincode</span>
                                                            <span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                                        </td>
                                                        <td align="left" style="width: 30%;">
                                                            <input name="cand_name" type="text" id="" title="" class="CapLetter form-control" style=" width:30%; display: inline;" value=""> (6 Digits)
                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>


                                        </td>
                                    </tr>

                                    <tr class="bg-info">
                                        <td colspan="2" class="heading2">
                                            <span>Educational Qualification ↓ </span>
                                            <input type="hidden" name="trow" id="tq" value="5">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" style="background: #fff; font-size: 13px; color: #6969de;">NOTE: The date of passing eligibility examination will be the date appearing on the marksheet or provisional certificate issued by the University / Institute. In case the result of a particular examination is posted on the website of the University / Institute, a certificate issued by the appropriate authority of the University / Institute indicating the date on which the result was posted on the website will be taken as the date of passing.</td>
                                    </tr>

                                    <tr style="font-size: 12pt">
                                        <td colspan="2" style="text-align: left">
                                            <div style="text-align: left">
                                                <table id="dynamic_field" class="table table-bordered" style="width: 100%">
                                                    <tbody>
                                                        <tr class="bg-danger">
                                                            <td align="left" style="font-weight: bold; color: white;" valign="top">Sr.No.</td>
                                                            <td align="left" style="font-weight: bold; color: white;" valign="top">Degree/Diploma</td>
                                                            <td align="left" style="font-weight: bold; color: white;" valign="top">Year</td>
                                                            <td align="left" style="font-weight: bold; color: white;" valign="top">Subjects taken</td>
                                                            <td align="left" style="font-weight: bold; color: white;" valign="top">University</td>
                                                            <td align="left" style="font-weight: bold; color: white;" valign="top">Division</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" style="" valign="top">
                                                                <strong>1.</strong>
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="deg[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="qyear[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="sub[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="uni[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="div[]" value="" class="form-control">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" style="" valign="top">
                                                                <strong>2.</strong>
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="deg[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="qyear[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="sub[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="uni[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="div[]" value="" class="form-control">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" style="" valign="top">
                                                                <strong>3.</strong>
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="deg[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="qyear[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="sub[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="uni[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="div[]" value="" class="form-control">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" style="" valign="top">
                                                                <strong>4.</strong>
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="deg[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="qyear[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="sub[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="uni[]" value="" class="form-control">
                                                            </td>
                                                            <td align="left" style="" valign="top">
                                                                <input type="text" name="div[]" value="" class="form-control">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <span class="pull-right"><button type="button" name="add" id="add" class="btn btn-success">Add</button></span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="bg-info">
                                        <td colspan="2" class="heading2">
                                            <span>Work Experience details (Start from present Employer) ↓ </span>
                                        </td>
                                    </tr>

                                    <tr style="font-size: 12pt">
                                        <td colspan="2" style="text-align: left">
                                            <div id="" style="width:100%;">
                                                <table style="width: 100%" class="table table-bordered">

                                                    <tbody>

                                                        <tr>
                                                            <td align="right" style="width: 30%;">
                                                                Brief Service particulars / Experience / Organization (Please enclosed a sheet if necessary)
                                                            </td>
                                                            <td align="left" style="width: 70%;">
                                                                <div class="form-inline">
                                                                    <textarea name="cand_brief_service_perticular" value="" type="text" rows="3" id="" title="" class="form-control" style="width:70%;"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right" style="width: 30%;">
                                                                Details of experience of working in Health sector &amp; E-health background
                                                            </td>
                                                            <td align="left" style="width: 70%;">
                                                                <div class="form-inline">
                                                                    <textarea name="cand_exp_in_health_sec" value="" type="text" rows="3" id="" title="" class="form-control" style="width:70%;"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>

                                            </div>
                                        </td>
                                    </tr>
                                    <!--<tr>
                                    <td style="text-align: right; height: 30%;">
                                        <span id="">Enter Verification Code :</span><span style="font-size: medium; color: #CC0000"><strong>*</strong></span>
                                    </td>
                                    <td style="text-align: left; height: 70%;">
                                        <div class="form-inline">
                                            <input name="captcha" id="captcha" type="text" maxlength="7" id="" title="Please Type Verification code" class="form-control" style="font-size:Large;width:150px;">
											<p id="captImg"><img style="padding-top: 0%;"  src="https://localhost/www/nihfw_post/captcha_images/1596520484.535.jpg"></p>
                                            <span id="" class="bg-warning" style="color:Red;display:none;">Please Type Verification Code</span>
                                        </div>
                                    </td>
                                </tr>-->
                                    <tr style="font-size: 12pt">
                                        <td style="text-align: left;" colspan="2">
                                            <div id="" class="bg-warning" style="color:Red; display:none;">
                                            </div>
                                            <span id="" style="display:inline-block; color:#FF0033; background-color:#FFFF66;font-size:12pt; width:100%;"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered" id="Table1">
                                <tbody>
                                    <tr class="bg-info">
                                        <td colspan="2" style="text-align: center;">
                                            <input type="submit" name="" value="Validate &amp; Preview" onclick="" id="" class="btn btn-success" style="font-weight:bold;width:250px;">
                                            &nbsp;<input type="submit" name="" value="Cancel" id="" class="btn btn-warning" style="width:150px;">
                                            &nbsp;<input type="submit" name="" value="Close" id="" class="btn btn-danger" style="width:150px;">
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