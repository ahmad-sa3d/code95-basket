<li class="list-group-item">
	<div class="row">
		<div class="col-sm-9">
			<h5 class="list-group-item-heading"><?php echo e($category->title); ?></h5>
		</div>
		<div class="col-sm-3 pull-right text-right">
			<a href="<?php echo e(route( 'admin.categories.show', $category->id )); ?>" class="no-underline" data-toggle="tooltip" title="show">
				<i class="fa fa-sitemap"></i>
			</a>
			<a href="<?php echo e(route( 'admin.categories.edit', $category->id )); ?>" class="margin-0-5 no-underline" data-toggle="tooltip" title="edit">
				<i class="glyphicon glyphicon-edit"></i>
			</a>
			<a href="<?php echo e(route( 'admin.categories.delete', $category->id )); ?>" class="no-underline text-danger" data-toggle="tooltip" title="delete">
				<i class="glyphicon glyphicon-trash"></i>
			</a>
		</div>
	</div>
</li>

<?php if( !$category->childs->isEmpty() ): ?>
	<ul class="level" level-for="<?php echo e($category->id); ?>" title="Childs of <?php echo e($category->title); ?>">
		<?php echo $__env->renderEach( 'admin.categories.partials.category', $category->childs, 'category' ); ?>
	</ul>
<?php endif; ?>