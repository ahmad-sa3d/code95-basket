<?php $__env->startSection( 'title', 'Product ' . $product->name ); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
						<h4 class="panel-title"><?php echo e($product->name); ?></h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="no-underline" data-toggle="tooltip" title="edit">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
						<a href="<?php echo e(route('admin.products.delete', $product->id)); ?>" class="no-underline margin-0-5" data-toggle="tooltip" title="delete">
							<span class="glyphicon glyphicon-trash text-danger"></span>
						</a>
						<a href="<?php echo e(route('admin.products.index')); ?>" class="no-underline" data-toggle="tooltip" title="all products">
							<span class="fa fa-cubes"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<dl>
				<div class="data-row">
					<dt class="data-name">Product name</dt>
					<dd class="data-value"><?php echo e($product->name); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Id</dt>
					<dd class="data-value"><?php echo e($product->id); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Price</dt>
					<dd class="data-value">
						<?php echo e($product->price); ?> <span class="badge yellow-bg font-size-m2"> L.E. </span>
						<?php if( $product->discount_percent ): ?>
							After Discount <span class="badge green-bg font-size-m2"><?php echo e($product->price - $product->discount); ?> L.E.</span>
						<?php endif; ?>
					</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Instock Quantity</dt>
					<dd class="data-value"><?php echo e($product->instock_quantity); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Discount percent</dt>
					<dd class="data-value"><?php echo $product->discount_percent ? $product->discount_percent . ' % ' . 'Equals <span class="badge green-bg">' . $product->discount . ' L.E.</span>' : 'No Discount For This Product'; ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Categories</dt>
					<dd class="data-value">
						<?php $__currentLoopData = $product->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<a class="btn btn-xs btn-warning" href="<?php echo e(route( 'admin.categories.show', $category->id )); ?>"><?php echo e($category->title); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Created At</dt>
					<dd class="data-value"><?php echo e($product->created_at->toDayDateTimeString()); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Last Update</dt>
					<dd class="data-value"><?php echo e($product->updated_at->toDayDateTimeString()); ?></dd>
				</div>
			</dl>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>