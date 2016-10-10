<?php $__env->startSection( 'title', 'System Users' ); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">All Users</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-8">
					<h5>All System Users <span class="badge green-bg"><?php echo e($users->total()); ?></span></h5>
				</div>
				<div class="col-xs-4">
					<p class="pull-right">
						<a href="<?php echo e(route('admin.users.create')); ?>" class="no-underline" data-toggle="tooltip" title="Create New User">
							<span class="glyphicon glyphicon-plus"></span>
							<span class="glyphicon glyphicon-user"></span>
						</a>
					</p>
				</div>
			</div>
			
		</div>
		<?php if( !$users->isEmpty() ): ?>
			<div class="table-responsive">
				<table class="table table-bordered text-center">
					<thead>
						<tr>
							<th class="col-xs-1 text-center">#</th>
							<th class="text-center">Username</th>
							<th class="text-center">Is Admin</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<tr>
								<td><?php echo e($loop->iteration); ?></td>
								<td><?php echo e($user->username); ?></td>
								<td><?php echo e($user->is_admin ? 'Yes' : 'No'); ?></td>
								<td>
									<a href="<?php echo e(route('admin.users.show', $user->id)); ?>" data-toggle="tooltip" title="Show <?php echo e($user->username); ?>" class="no-underline">
										<span class="glyphicon glyphicon-user"></span>
									</a>
									<a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" data-toggle="tooltip" title="Edit <?php echo e($user->username); ?>" class="margin-0-5 no-underline">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a href="<?php echo e(route('admin.users.delete', $user->id)); ?>" data-toggle="tooltip" title="Delete <?php echo e($user->username); ?>" class="no-underline">
										<span class="glyphicon glyphicon-trash text-danger"></span>
									</a>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</tbody>
					<?php if( $users->hasPages() ): ?>
						<tfoot>
							<tr>
								<td colspan="4" class="text-left">
									<?php echo e($users->links()); ?>

								</td>
							</tr>
						</tfoot>
					<?php endif; ?>
				</table>
			</div>
		<?php endif; ?>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>