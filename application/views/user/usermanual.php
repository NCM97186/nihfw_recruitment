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

          <h3>Coming Soon</h3>
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