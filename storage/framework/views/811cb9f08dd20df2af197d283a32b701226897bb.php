<?php $__env->startSection( 'title', 'Invoice ' . $invoice->id ); ?>

<?php $__env->startPush( 'styles' ); ?>
	<?php echo e(Html::style( '/css/basket.css' )); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush( 'scripts' ); ?>
	<?php echo e(Html::script( '/js/jquery.print.min.js' )); ?>

	<script>
		function printBarcode(event)
    	{
    		event.preventDefault();
    		event.stopPropagation();
    		$('.print').print();
    	}
	</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
						<h4 class="panel-title">Invoice # <?php echo e($invoice->id); ?></h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="#" data-toggle="tooltip" title="Print" class="no-underline font-size-p1 margin-r5 text-muted" onclick="printBarcode( event );">
		        			<span class="glyphicon glyphicon-print"></span>
		        		</a>

						<a href="<?php echo e(route('admin.invoices.index')); ?>" class="no-underline" data-toggle="tooltip" title="all invoices">
							<span class="fa fa-money"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<?php echo $__env->make( 'includes.invoice' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>