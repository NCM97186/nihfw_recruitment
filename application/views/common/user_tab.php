<div class="tabbable">
	<?php $method = $this->router->fetch_method();
	$user_id = $_SESSION['USER']['user_id'];?>
        <ul class="nav nav-tabs wizard">
            
            <li class="<?php echo ($method==='basicinfo')?'active':'' ?>"><a href="<?php echo base_url('dashboard/basicinfo') ?>">Candidate Information</a></li>
            <li class="<?php echo ($method==='basic_details')?'active':'' ?>"><a href="<?php echo (!empty($user_id))? base_url('dashboard/basic_details'):'#'; ?>">Basic & Personal Details </a></li>
            <li class="<?php echo ($method==='qualifications_employer')?'active':'' ?>"><a href="<?php echo (!empty($user_id))? base_url('dashboard/qualifications_employer'):'#'; ?>">Qualification & Employer</a></li>
            <li class="<?php echo ($method==='photo_signature')?'active':'' ?>"><a href="<?php echo (!empty($user_id))? base_url('dashboard/photo_signature'):'#'; ?>">Photo and Signature</a></li>
            <li class="<?php echo ($method==='preview')?'active':'' ?>"><a href="<?php echo (!empty($user_id))? base_url('dashboard/preview'):'#'; ?>" data-toggle="tab" aria-expanded="false">Preview</a></li>
            <!-- <li class=""><a href="#upload" data-toggle="tab" aria-expanded="true"><span class="nmbr">5</span>Uploads</a></li> -->
            <li class="" ><a href="#payment" data-toggle="tab" aria-expanded="true">Payment</a></li>

        </ul>
    </div>