<li>
    <a href="<?php echo e(route( 'invoice', $notification->data['id'] )); ?>">
        <i class="fa fa-money green-font"></i>
        <span class="text">New invoice with total of <span class="badge badge-info no-margin"><?php echo e($notification->data['net']); ?> L.E.</span></span>
		<span class="timestamp">
    		<span class="fa fa-clock-o"></span>
    		<?php echo e(\Carbon\Carbon::parse( $notification->data['created_at'] )->diffForHumans()); ?>

    	</span>
    </a>
</li>