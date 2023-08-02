<?php 
$extra = array('class'=>'form-control error');
if(isset($role_required) ){
  $extra =array('required' => true);
} 
?>
<div class="form-group">

	<label >Role Type</label>


	  <?php
		$roleList = get_role_list();
		$use_role_id = 0;
		if(isset($role_id)) {$use_role_id = $role_id;}
		echo form_dropdown('role_id', $roleList, $use_role_id , $extra);	
		?>		
		<span class="form_error"><?php echo form_error('role_id'); ?></span>
	  <?php  ?>
	</div>