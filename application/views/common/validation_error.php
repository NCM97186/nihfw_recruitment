<?php if(validation_errors()) {?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
			<div class="alert-icon">
				<i class="fa fa-times"></i>
			</div>
			<div class="alert-message">
				<span><strong>Error!</strong> Required Field is Missing</span>
			</div>
	</div>                     
<?php  }?>