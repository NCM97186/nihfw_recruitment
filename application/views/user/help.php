<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
?>


<div style="display:flex;">
<?php
  $this->load->view('user/sidebar.php');
?>

<div id="main" class=" w-100">
<!-- <button class="openbtn" onclick="openNav()">☰</button> -->
<div class="text-center" style="margin-bottom:20px;">
    <h3>How Can We Help You ?</h3>
    <!-- <p>Create professional website designs. Responsive, fully customizable with easy Drag-n-Drop Nicepage editor. Adjust colors, fonts, header and footer, layout and other design elements, as well as content and images.</p> -->
</div>
<div class="col-lg-12 d-flex justify-content-center" style="gap:20px; margin-bottom:20px">

    <div class="col-lg-5 text-center contact_box national_form_border" style="height:auto">

        <i class="fa fa-solid fa-book" style="color:black; font-size: xxx-large; margin-top:10px;"></i>
  <p style="font-size:15px; padding:5px;">
  
    Baba Gang Nath Marg, Munirka, New Delhi-110067.<br>
    Gram: SWASTH PARIVAR</p>

</div>
<div class="col-lg-5 text-center contact_box  national_form_border" style="height:auto">

    <i class="fa fa-phone" style="color:black; font-size: xxx-large; margin-top:10px;"></i>
  <p style="font-size:15px; padding:5px;">

  NIHFW Helpline Number- 011-26165959<br>
    <!-- NIHFW Helpline Number- 011-26165959<br>
    Fax: 91-11-2610 1623<br>
    E-Mail: recruit.admin1@nihfw.org<br> Website: www.nihfw.org<br> -->
 

</div>
</div>
<div class="col-lg-12 d-flex justify-content-center" style="gap:20px;">
<div class="col-lg-5 text-center contact_box  national_form_border" style="height:auto; min-height:128px;">

<i class="fa fa-fax" style="color:black; font-size: xxx-large; margin-top:10px;"></i>
  <p style="font-size:15px; padding:5px;">
    <!-- Baba Gang Nath Marg, Munirka, New Delhi-110067.<br> -->
    <!-- NIHFW Helpline Number- 011-26165959<br>-->
    Fax: 91-11-2610 1623<br>
   <!-- E-Mail: recruit.admin1@nihfw.org<br> Website: www.nihfw.org<br> -->
    <!-- Gram: SWASTH PARIVAR</p> -->

</div>
<div class="col-lg-5 text-center contact_box  national_form_border" style="height:auto">

<i class="fa fa-envelope" style="color:black; font-size: xxx-large; margin-top:10px;"></i>
  <p style="font-size:15px; padding:5px;">
    <!-- Baba Gang Nath Marg, Munirka, New Delhi-110067.<br> -->
    <!-- NIHFW Helpline Number- 011-26165959<br>
    Fax: 91-11-2610 1623<br> -->
    E-Mail: recruit.admin1@nihfw.org<br>
    <!-- Gram: SWASTH PARIVAR</p> -->

</div>
</div>

</div>


</div>
<!-- captcha refresh code -->
<script>
    jQuery(document).ready(function() {
        jQuery('.refreshCaptcha').on('click', function() {
            jQuery.get('<?php echo base_url() . 'login/refresh_captcha'; ?>', function(data) {
                $('#captImg').html(data);
            });
        });
    });
</script>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/additional-methods.js"></script>-->