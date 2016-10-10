<?php $__env->startSection( 'title', 'Delete Category ' . $category->title ); ?>

<?php $__env->startPush( 'styles' ); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush( 'scripts' ); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
					<h4 class="panel-title "><i class="text-danger fa fa-trash padding-r5"></i> <?php echo e($category->title); ?></h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="<?php echo e(route('admin.categories.edit', $category->id)); ?>" class="no-underline" data-toggle="tooltip" title="edit">
							<span class="glyphicon glyphicon-edit"></span>
						</a>

						<a href="<?php echo e(route('admin.categories.show', $category->id)); ?>" class="no-underline margin-0-5" data-toggle="tooltip" title="Back To user">
							<span class="fa fa-user"></span>
						</a>

						<a href="<?php echo e(route('admin.categories.index')); ?>" class="no-underline" data-toggle="tooltip" title="all categories">
							<span class="fa fa-group"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<h4>Deleting Status :</h4>
			
					<table class="table table-bordered table-stripped table-hover">
						<thead>
							<tr>
								<th>Dependency</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Sub Categories Count</td>
								<td><?php echo e($category->children->count()); ?></td>
							</tr>
							<tr>
								<td>Category Products Count</td>
								<td><?php echo e($category->products->count()); ?></td>
							</tr>
						</tbody>
						<tfoot>
							<tr class="<?php echo e($category->isSafelyDelete() ? 'bg-success' : 'bg-danger'); ?>">
								<th>Safe To delete</th>
								<th><?php echo e($category->isSafelyDelete() ? 'Yes' : 'No'); ?></th>
							</tr>
						</tfoot>
					</table>
			

			<form class="form-inline" method="POST" action="<?php echo e(route( 'admin.categories.destroy', $category->id )); ?>">
				<?php echo e(csrf_field()); ?>

				<?php echo e(method_field( 'DELETE' )); ?>


				<button class="btn btn-danger btn-sm">Confirm Delete</button>
			</form>
		</div>
	</div>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>