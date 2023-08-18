<div class="tabbable">
	<?php $method = $this->router->fetch_method();
	$user_id = $_SESSION['USER']['user_id'];?>
        <ul class="nav nav-tabs wizard">
            
            <li class="<?php echo ($method==='basicinfo')?'active':'' ?>"><a href="<?php echo base_url('dashboard/basicinfo') ?>"><span class="nmbr">1</span>Candidate Information</a></li>
            <li class="<?php echo ($method==='basic_details')?'active':'' ?>"><a href="<?php echo (!empty($user_id))? base_url('dashboard/basic_details'):'#'; ?>"><span class="nmbr">2</span>Basic & Personal Details </a></li>
            <li class="<?php echo ($method==='qualifications_employer')?'active':'' ?>"><a href="<?php echo (!empty($user_id))? base_url('dashboard/qualifications_employer'):'#'; ?>"><span class="nmbr">3</span>Qualification & Employer</a></li>
            <li class="<?php echo ($method==='photo_signature')?'active':'' ?>"><a href="<?php echo (!empty($user_id))? base_url('dashboard/photo_signature'):'#'; ?>"><span class="nmbr">4</span>Photo and Signature</a></li>
            <li class="<?php echo ($method==='preview')?'active':'' ?>"><a href="<?php echo (!empty($user_id))? base_url('dashboard/preview'):'#'; ?>" data-toggle="tab" aria-expanded="false"><span class="nmbr">5</span>Preview</a></li>
            <!-- <li class=""><a href="#upload" data-toggle="tab" aria-expanded="true"><span class="nmbr">5</span>Uploads</a></li> -->
            <li class="" ><a href="#payment" data-toggle="tab" aria-expanded="true"><span class="nmbr">6</span>Payment</a></li>

        </ul>
    </div>