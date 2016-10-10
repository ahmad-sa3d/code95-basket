<?php $__env->startSection( 'title', 'Delete Product ' . $product->name ); ?>

<?php $__env->startPush( 'styles' ); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush( 'scripts' ); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
					<h4 class="panel-title "><i class="text-danger fa fa-trash padding-r5"></i> <?php echo e($product->name); ?></h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="<?php echo e(route('admin.products.show', $product->id)); ?>" class="no-underline" data-toggle="tooltip" title="show">
							<span class="glyphicon glyphicon-eye-open"></span>
						</a>

						<a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="no-underline margin-0-5" data-toggle="tooltip" title="edit">
							<span class="glyphicon glyphicon-edit"></span>
						</a>

						<a href="<?php echo e(route('admin.products.index')); ?>" class="no-underline" data-toggle="tooltip" title="all products">
							<span class="fa fa-cubes"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<h4>Deleting Status :</h4>
			<blockquote class="text-muted">
				Be aware that deleting products may affect on the application as it might have related data like sales and invoices
				we recommended you not to delete Any product if it has related data.
			</blockquote>

			<form class="form-inline" method="POST" action="<?php echo e(route( 'admin.products.destroy', $product->id )); ?>">
				<?php echo e(csrf_field()); ?>

				<?php echo e(method_field( 'DELETE' )); ?>


				<button class="btn btn-danger btn-sm">Confirm Delete</button>
			</form>
		</div>
	</div>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>