<?php $__env->startSection( 'title', 'Invoice #' . $invoice->id ); ?>

<?php $__env->startPush( 'styles' ); ?>
	<?php echo e(Html::style( '/css/selectize.min.css' )); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startPush( 'scripts' ); ?>
	<?php echo e(Html::script( '/js/selectize.min.js' )); ?>

	<script>
		function printBarcode(event)
    	{
    		event.preventDefault();
    		event.stopPropagation();
    		$('.print').print();
    	}

		// Very Important For /js/basket.min.js to work
		orderItems = JSON.parse( '<?php echo ( $order ) ? json_encode( $order->items->map( function($item){ return $item["quantity"]; } ), JSON_FORCE_OBJECT ) : "{}"; ?>' );
	</script>
	<?php echo e(Html::script( '/js/basket.min.js' )); ?>

	<?php echo e(Html::script( '/js/jquery.print.min.js' )); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
        	<div class="col-xs-9">
        		<h4 class="panel-title">Invoice # <?php echo e($invoice->id); ?></h4>
        	</div>
        	<div class="col-xs-3 text-right">
        		<a href="#" data-toggle="tooltip" title="Print" class="no-underline font-size-p1 margin-r5 text-muted" onclick="printBarcode( event );">
        			<span class="glyphicon glyphicon-print"></span>
        		</a>
        		<a href="#" data-toggle="tooltip" title="Print" class="no-underline font-size-p1 text-muted">
        			<span class="glyphicon glyphicon-home"></span>
        		</a>
        	</div>
        </div>
        
    </div>

    <div class="panel-body">
		<?php echo $__env->make( 'includes.invoice' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>