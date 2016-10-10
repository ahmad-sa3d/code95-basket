<?php $__env->startSection( 'title', 'Category ' . $category->title ); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
						<h4 class="panel-title"><?php echo e($category->title); ?></h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="<?php echo e(route('admin.categories.edit', $category->id)); ?>" class="no-underline" data-toggle="tooltip" title="edit">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
						<a href="<?php echo e(route('admin.categories.delete', $category->id)); ?>" class="no-underline margin-0-5" data-toggle="tooltip" title="delete">
							<span class="glyphicon glyphicon-trash text-danger"></span>
						</a>
						<a href="<?php echo e(route('admin.categories.index')); ?>" class="no-underline" data-toggle="tooltip" title="all categories">
							<span class="fa fa-sitemap"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<dl>
				<div class="data-row">
					<dt class="data-name">Title</dt>
					<dd class="data-value"><?php echo e($category->title); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Id</dt>
					<dd class="data-value"><?php echo e($category->id); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Description</dt>
					<dd class="data-value"><?php echo e($category->description); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Products</dt>
					<dd class="data-value"><?php echo e($category->products->count()); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Parent category</dt>
					<dd class="data-value">
						<?php if( $category->parent ): ?>
							<a href="<?php echo e(route( 'admin.categories.show', $category->parent->id )); ?>" class="btn btn-info btn-xs"><?php echo e($category->parent->title); ?></a>
						<?php else: ?>
							---
						<?php endif; ?>
					</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Child categories</dt>
					<dd class="data-value">
						<?php if( $category->childs->isEmpty() ): ?>
							No Childs For This category
						<?php else: ?>
							<?php $__currentLoopData = $category->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<a href="<?php echo e(route( 'admin.categories.show', $child->id )); ?>" class="btn btn-warning btn-xs"><?php echo e($child->title); ?></a>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						<?php endif; ?>
					</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Created At</dt>
					<dd class="data-value"><?php echo e($category->created_at->toDayDateTimeString()); ?></dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Last Update</dt>
					<dd class="data-value"><?php echo e($category->updated_at->toDayDateTimeString()); ?></dd>
				</div>
			</dl>
			<hr>
			<?php if( !$category->childs->isEmpty() ): ?>
				<h5 class="text-primary text-center">List all Categories in Hirearchy</h5>
				
					<ul class="list-group">
						<?php echo $__env->make( 'admin.categories.partials.category' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</ul>
				
			<?php endif; ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>