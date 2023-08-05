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

<div id="main" class="w-100 container">
<button class="openbtn" onclick="openNav()">☰</button>
            <div class="panel container panel-info national_form_border">

          <p style="font-size:15px; padding:15px;">Baba Gang Nath Marg, Munirka, New Delhi-110067.<br>
Phones: 91-11-2616 5959, 91-11-2616 6441, 91-11-2618 8485, 91-11-2610 7773, 91-11-26189640, 91-11-26108906<br>
Fax: 91-11-2610 1623<br>
E-Mail: info@nihfw.org <br> Web Site: www.nihfw.org<br>
Gram: SWASTH PARIVAR</p>
     <!-- Main body End Here -->
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