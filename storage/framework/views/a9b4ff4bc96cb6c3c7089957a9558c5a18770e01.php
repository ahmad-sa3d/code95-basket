<?php $__env->startSection( 'title', 'User ' . $user->username ); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
						<h4 class="panel-title"><?php echo e($user->username); ?></h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="no-underline" data-toggle="tooltip" title="edit">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
						<a href="<?php echo e(route('admin.users.delete', $user->id)); ?>" class="no-underline margin-0-5" data-toggle="tooltip" title="delete">
							<span class="glyphicon glyphicon-trash text-danger"></span>
						</a>
						<a href="<?php echo e(route('admin.users.index')); ?>" class="no-underline" data-toggle="tooltip" title="all users">
							<span class="fa fa-group"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<dl>
				<div class="data-row">
					<dt class="data-name">User name</dt>
					<dd class="data-value"><?php echo e($user->username); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">User Id</dt>
					<dd class="data-value"><?php echo e($user->id); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Is Admin</dt>
					<dd class="data-value"><?php echo e($user->is_admin ? 'Yes' : 'No'); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Is Active</dt>
					<dd class="data-value"><?php echo e($user->is_active ? 'Yes' : 'No'); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Created At</dt>
					<dd class="data-value"><?php echo e($user->created_at->toDayDateTimeString()); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Last Update</dt>
					<dd class="data-value"><?php echo e($user->updated_at->toDayDateTimeString()); ?></dd>
				</div>
			</dl>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>