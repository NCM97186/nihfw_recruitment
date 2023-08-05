<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
// echo $_SESSION['saltCookie'].'<br>'.$_SESSION['salt'];
// print_r($captcha);
// die();
?>
<div class="login-box-area">

                    
                   
          <?php $this->load->view('common/messages.php'); ?>
    <div class="row container" style="display:flex;">
        <div class="login-box col-lg-6 col-md-5 col-sm-12">
            <h2>Login</h2>
            <p>Provide your User Name and Password to Login</p>
        <form method="post" action="<?php echo base_url('user/getlogin')?>" enctype="multipart/form-data">
        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
             <?php
                    if($this->session->flashdata('message')!=''){
                        $message    =   $this->session->flashdata('message');
                        if($message!=''){
                            echo '<div style="padding:5px !important;" class="alert alert-danger"><button type="button" class="btn btn-danger" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Oh snap!</strong> '.$message.'.</div>';
                        }
                        $this->session->unset_userdata('message');
                    }
                ?>
            <div class="field-row">
                <input type="text" onkeypress="ValidateNumberOnly();" class="box" name="cand_mob" placeholder="Enter Registration Number" value="<?php echo set_value('cand_mob'); ?>"/>
                <span class="form_error"><?php echo form_error('cand_mob'); ?></span>
            </div>
            <div class="field-row">
                <input class="box" id="password" type="password" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>">
                <span class="form_error"><?php echo form_error('password'); ?></span>
            </div>
            <?php if(isset($captcha['image']) || isset($captcha['word'])) { ?>
                            
                            <div class="field-row">
                                <div class="row">
                                    <div class="col-md-6">
                                    <p style="display:flex;"><span id="captImg"><?php echo $captcha['image'];?></span>
                               
                               <img id="refreshCaptcha" style="width: 27px; margin: 10px 6px;" src="<?php echo base_url('') ?>assets/img/refresh.png" alt="image">
                               </p>
                                    </div>
                                    <div class="col-md-6">
                                    <input type="text" class="box" name="captcha" id="captcha" autocomplete="off" placeholder="Enter text here">
                                <span class="form_error"><?php echo form_error('captcha'); ?></span>
                                    </div>
                                </div>
                                   
                                   
                                 <input type='hidden' name='code' value='<?php echo $captcha["word"];?>'>
                              
                            </div>
                        <?php  } ?>
            
            <div class="field-row"><a class="forgot-password" href="<?php echo base_url('user/forgotPassword')?>" target="_parent">Forgot Username &amp; Password</a>
                
                     <input type="submit" name="login" id="loginform" onclick="return getPass();" class="login-btn" value="Submit" />
                
            <!--<a href=""><span class="login-btn">
                    <span id="" data-ref="btnInnerEl" unselectable="on" class="x-btn-inner x-btn-inner-default-small">Log In</span>
                </span></a>-->
            </div>
        </form>
        </div>

        <div class="login-box-content col-lg-6 col-md-6 col-sm-12">
            <h2>Welcome to the <span>NIHFW</span> Online Application Portal</h2>
            <div class="bnr-btn">
                <a href="<?php echo base_url('user/registration') ?>" class="hvr-bounce-to-right scroll" >Online Registration</a>

            </div>


        </div>
    </div>
</div>


<div class="contact-page-area padding-bottom">
    <div class="container-fluid">
        <div id="national_form" style="text-align: center">
            <div class="panel panel-info national_form_border">
                <div class="panel-body">
                    <div id="" style="text-align: left; background-color: White; width: 100%;overflow-x:auto;display: block;">
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
                                                <thead>
                                                    <tr class="bg-danger">
                                                        <td align="center" style="font-weight: 400; color: white;" valign="top">Sr.No.</td>
                                                        <td align="center" style="font-weight: 400; color: white;" valign="top">Examination Name</td>
                                                        <td align="center" style="font-weight: 400; color: white;" valign="top">Advt. Number , Date</td>
                                                        <td align="center" style="font-weight: 400; color: white;" valign="top">Start Date</td>
                                                        
                                                        <td align="center" style="font-weight: 400; color: white;" valign="top">Form Submission Last Date</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  
                                                    // echo "<pre>";
                                                    // print_r($result);
                                                    // die();
                                                    $i = 1;
                                                    foreach ($result as $results) { ?>


                                                    <tr>
                                                        <td align="center">
                                                            <strong><?php echo $i; ?></strong>
                                                        </td>
                                                        <td align="center"><?php echo $results->post_name; ?></td>
                                                        <td align="center"><?php echo $results->adver_no.",".$results->adver_date; ?></td>
                                                        <td align="center"><?php echo date("d-m-Y", strtotime($results->start_date)); ?></td>
                                                        <td align="center"><?php echo date("d-m-Y", strtotime($results->last_date)); ?></td>
                                                        
                                                        <td align="center">
                                                            <?php if($results->link_to_pdf!='pending'){?>
                                                                <a class="btn btn-info" href="<?php echo base_url() ?>uploads/link_to_pdf/<?php echo $results->link_to_pdf; ?>" target="_New"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View Advertisement</a>
                                                            <?php } ?>
                                                        </td>
                                                        
                                                        <td align="center">
                                                         <?php if(isset($_SESSION['USER']['user_id'])){?>
                                                            <a id="apply_post" onClick="saveCookie(<?php echo $results->post_id; ?>)" class="btn btn-success" data-post="<?php echo $results->post_id; ?>" href="<?php echo base_url('dashboard/basicinfo') ?>"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Apply</a>
                                                        <?php } else{ ?>
                                                             <a id="apply_post" onClick="msg()" class="btn btn-success" ><i class="fa fa-check-circle-o" aria-hidden="true"></i> Apply</a>
                                                        <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                } ?>
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
<!-- captcha refresh code -->
<script>
jQuery(document).ready(function(){
    jQuery('#refreshCaptcha').on('click', function(){
        jQuery.get('<?php echo base_url().'User/refresh_captcha'; ?>', function(data){
            $('#captImg').html(data);
        });
    });
});
</script>
<script>
    function setCookie(key, value, expiry) {
   
        var expires = new Date();
        expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
        document.cookie = key + '=' + value + ';path=/;expires=' + expires.toUTCString();
        
    }
    function saveCookie(id){
       
        setCookie('post_id',id,'1'); 
            
    }
    function delete_cookie(name) {
  document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
    
</script>
<script src="<?php echo base_url('assets/js/sha512.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/getpwd.js'); ?>"></script>
		
<script type="text/javascript" language="javascript">
function msg()
{
    alert("Please Login First For Applying Jobs.");
}
    
    function getPass()
      {
      
      var salt = '<?php echo $_SESSION['salt']; ?>'; 
      var exp= /((?=.*\d)(?=.*[a-z])(?=.*[@#$%]).{6,10})/;
         
      var value = document.getElementById('password').value;

        
      if (value=='')
          {
              alert('Please enter username and password');
              return false;
          }
          else
          {
        
              
              if (value!='')
              {
          
         
           var hash= '';
      
           var hash = hex_sha512(value) + salt;
          document.getElementById('password').value=hash;
          document.getElementById("loginform").submit();
          return true;
              }
  
          }
      }
    
  
  </script>
  <script>
 function ValidateNumberOnly()
{
if ((event.keyCode < 48 || event.keyCode > 57)) 
{
   event.returnValue = false;
}
}
    </script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>

let table = new DataTable('#dynamic_field');
</script>