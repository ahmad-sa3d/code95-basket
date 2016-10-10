		
<div class="row">
	<div class="col-md-12 ">
		
		<?php echo $__env->make( 'admin.includes.notification' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
		<?php echo $__env->yieldContent( 'content' ); ?>

	</div>
</div>

