<?php $__env->startSection( 'title', 'Delete User ' . $user->username ); ?>

<?php $__env->startPush( 'styles' ); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush( 'scripts' ); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
					<h4 class="panel-title "><i class="text-danger fa fa-trash padding-r5"></i> <?php echo e($user->username); ?></h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="no-underline" data-toggle="tooltip" title="edit">
							<span class="glyphicon glyphicon-edit"></span>
						</a>

						<a href="<?php echo e(route('admin.users.show', $user->id)); ?>" class="no-underline margin-0-5" data-toggle="tooltip" title="Back To user">
							<span class="fa fa-user"></span>
						</a>

						<a href="<?php echo e(route('admin.users.index')); ?>" class="no-underline" data-toggle="tooltip" title="all users">
							<span class="fa fa-group"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<h4>Deleting User :</h4>
			<blockquote class="text-muted">
					Deleting user might affect application data as user might have related actions
					We Recommended You To <code>deactivate</code> User Instead of Delete
			</blockquote>

			<form class="form-inline" method="POST" action="<?php echo e(route( 'admin.users.destroy', $user->id )); ?>">
				<?php echo e(csrf_field()); ?>

				<?php echo e(method_field( 'DELETE' )); ?>


				<button class="btn btn-danger btn-sm">Confirm Delete</button>
			</form>
		</div>
	</div>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>