<?php $__env->startSection( 'title', 'System Products' ); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">Products</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-8">
					<h5>All Products <span class="badge green-bg"><?php echo e($products->total()); ?></span></h5>
				</div>
				<div class="col-xs-4">
					<p class="pull-right">
						<a href="<?php echo e(route('admin.products.create')); ?>" class="no-underline" data-toggle="tooltip" title="New Product">
							<span class="glyphicon glyphicon-plus"></span>
							<span class="fa fa-cubes"></span>
						</a>
					</p>
				</div>
			</div>
			
		</div>
		<?php if( !$products->isEmpty() ): ?>
			<div class="table-responsive">
				<table class="table table-bordered text-center">
					<thead>
						<tr>
							<th class="col-xs-1 text-center">#</th>
							<th class="text-center">Name</th>
							<th class="text-center">Instock Quantity</th>
							<th class="text-center">Price ( L.E. )</th>
							<th class="text-center">Discount (%)</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<tr>
								<td><?php echo e($loop->iteration); ?></td>
								<td><?php echo e($user->name); ?></td>
								<td><?php echo e($user->instock_quantity); ?></td>
								<td><?php echo e($user->price); ?></td>
								<td><?php echo e($user->discount_percent ?  $user->discount_percent: 0); ?></td>
								<td>
									<a href="<?php echo e(route('admin.products.show', $user->id)); ?>" data-toggle="tooltip" title="Show <?php echo e($user->username); ?>" class="no-underline">
										<span class="glyphicon glyphicon-user"></span>
									</a>
									<a href="<?php echo e(route('admin.products.edit', $user->id)); ?>" data-toggle="tooltip" title="Edit <?php echo e($user->username); ?>" class="margin-0-5 no-underline">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a href="<?php echo e(route('admin.products.delete', $user->id)); ?>" data-toggle="tooltip" title="Delete <?php echo e($user->username); ?>" class="no-underline">
										<span class="glyphicon glyphicon-trash text-danger"></span>
									</a>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</tbody>
					<?php if( $products->hasPages() ): ?>
						<tfoot>
							<tr>
								<td colspan="6" class="text-left">
									<?php echo e($products->links()); ?>

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