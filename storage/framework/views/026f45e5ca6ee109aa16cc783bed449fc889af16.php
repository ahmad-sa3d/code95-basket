<?php $__env->startSection( 'title', 'System Categories' ); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">All Categories</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-8">
					<h5>All System Categories <span class="badge green-bg"><?php echo e(App\Category::count()); ?></span></h5>
				</div>
				<div class="col-xs-4">
					<p class="pull-right">
						<a href="<?php echo e(route('admin.categories.create')); ?>" class="no-underline" data-toggle="tooltip" title="New Category">
							<span class="glyphicon glyphicon-plus"></span>
							<span class="fa fa-sitemap"></span>
						</a>
					</p>
				</div>
			</div>

			
			<?php if( !$categories->isEmpty() ): ?>
				<h5 class="text-primary text-center">List all Categories in Hirearchy</h5>
				
					<ul class="list-group">
						<?php echo $__env->renderEach( 'admin.categories.partials.category', $categories, 'category' ); ?>
					</ul>
				
			<?php endif; ?>
			
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>