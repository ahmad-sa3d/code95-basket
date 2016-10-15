<li>
    <a href="<?php echo e(route( 'admin.products.show', $notification->data['id'] )); ?>">
        <i class="fa fa-cubes text-info"></i>
        <span class="text">Product <?php echo e($notification->data['name']); ?> Quantity reached to <span class="badge badge-warning no-margin"><?php echo e($notification->data['instock_quantity']); ?></span></span>
    	<span class="timestamp">
    		<span class="fa fa-clock-o"></span>
    		<?php echo e(\Carbon\Carbon::parse( $notification->data['updated_at'] )->diffForHumans()); ?>

    	</span>
    </a>
</li>