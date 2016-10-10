<?php $__env->startSection( 'title', 'Edit Product ' . $product->name ); ?>

<?php $__env->startPush( 'styles' ); ?>
	<?php echo e(Html::style( '/css/selectize.min.css' )); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush( 'scripts' ); ?>
	<?php echo e(Html::script( '/js/selectize.min.js' )); ?>

	<script>
		$('select').selectize();
	</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
					<h4 class="panel-title"><i class="fa fa-edit padding-r5"></i><?php echo e($product->name); ?></h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="<?php echo e(route('admin.products.show', $product->id)); ?>" class="no-underline" data-toggle="tooltip" title="show">
							<span class="glyphicon glyphicon-eye-open"></span>
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
			<?php echo e(Form::model( $product, [
					'route' => [ 'admin.products.update', $product->id ],
					'method' => 'PATCH',
					'class' => 'form-horizontal',
				] )); ?>

				
				<div class="form-group<?php echo e($errors->has( 'name' ) ? ' has-error' : ''); ?>">
					<label for="name" class="control-label col-xs-12 col-sm-2">Product Name</label>
					<div class="col-xs-12 col-sm-10">
						<?php echo e(Form::text( 'name', null, [ 'class'=>'form-control', 'id' => 'name', 'required', 'autofocus', 'tabindex'=>1 ] )); ?>

						<?php if( $errors->has( 'name' ) ): ?>
							<p class="help-block">
								<?php echo e($errors->first('name')); ?>

							</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has( 'instock_quantity' ) ? ' has-error' : ''); ?>">
					<label for="instock-quantity" class="control-label col-xs-12 col-sm-2">Instock Quantity</label>
					<div class="col-xs-12 col-sm-10">
						<?php echo e(Form::number( 'instock_quantity', null, [ 'class'=>'form-control', 'id' => 'instock-quantity', 'required', 'tabindex'=>2, 'min'=>0, 'step'=>1 ] )); ?>

						<?php if( $errors->has( 'instock_quantity' ) ): ?>
							<p class="help-block">
								<?php echo e($errors->first('instock_quantity')); ?>

							</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has( 'price' ) ? ' has-error' : ''); ?>">
					<label for="price" class="control-label col-xs-12 col-sm-2">Price</label>
					<div class="col-xs-12 col-sm-10">
						<div class="input-group col-xs-12">
							<?php echo e(Form::number( 'price', null, [ 'class'=>'form-control', 'id' => 'price', 'required', 'tabindex'=>3, 'min'=>0, 'step'=>.25 ] )); ?>

							<span class="input-group-addon width-50">L.E.</span>
						</div>
						<?php if( $errors->has( 'price' ) ): ?>
							<p class="help-block">
								<?php echo e($errors->first('price')); ?>

							</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has( 'discount_percent' ) ? ' has-error' : ''); ?>">
					<label for="discount-pct" class="control-label col-xs-12 col-sm-2">Discount</label>
					<div class="col-xs-12 col-sm-10">
						<div class="input-group col-xs-12">
							<?php echo e(Form::number( 'discount_percent', null, [ 'class'=>'form-control', 'id' => 'discount-pct', 'tabindex'=>4, 'min'=>0, 'step'=>1, 'max'=>100 ] )); ?>

							<span class="input-group-addon width-50">%</span>
						</div>
						<?php if( $errors->has( 'discount_percent' ) ): ?>
							<p class="help-block">
								<?php echo e($errors->first('discount_percent')); ?>

							</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has( 'categories' ) ? ' has-error' : ''); ?>">
					<label for="categories" class="control-label col-xs-12 col-sm-2">Categories</label>
					<div class="col-xs-12 col-sm-10">
						<?php echo e(Form::select( 'categories', $categories, $product->categories->pluck('id')->all(), [ 'name' => 'categories[]', 'multiple', 'class'=>'form-control', 'id' => 'categories', 'tabindex'=>5 ] )); ?>

						<?php if( $errors->has( 'categories' ) ): ?>
							<p class="help-block">
								<?php echo e($errors->first('categories')); ?>

							</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has( 'description' ) ? ' has-error' : ''); ?>">
					<label for="description" class="control-label col-xs-12 col-sm-2">Description</label>
					<div class="col-xs-12 col-sm-10">
						<?php echo e(Form::textarea( 'description', null, [ 'class'=>'form-control', 'id' => 'description', 'tabindex'=>6, 'required' ] )); ?>

						<?php if( $errors->has( 'description' ) ): ?>
							<p class="help-block">
								<?php echo e($errors->first('description')); ?>

							</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-success" type="submit" tabindex=7>Save</button>
					</div>
				</div>

			<?php echo e(Form::close()); ?>

			
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>