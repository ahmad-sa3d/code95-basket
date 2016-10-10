<?php $__env->startSection( 'title', 'Shop Name' ); ?>

<?php $__env->startPush( 'styles' ); ?>
	<?php echo e(Html::style( '/css/selectize.min.css' )); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush( 'scripts' ); ?>
	<?php echo e(Html::script( '/js/selectize.min.js' )); ?>

	<script>
		var $form = $('#category-form');

		$('select').selectize();

		$('#categories').change( function(e){

			if( this.value != 0 )
				$form[0].submit();
			else
				window.location.href = window.location.origin + window.location.pathname;

		} );

		// Very Important For /js/basket.min.js to work
		orderItems = JSON.parse( '<?php echo ( $order ) ? json_encode( $order->items->map( function($item){ return $item["quantity"]; } ), JSON_FORCE_OBJECT ) : "{}"; ?>' );
	</script>
	<?php echo e(Html::script( '/js/basket.min.js' )); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Products</h4>
        </div>

        <div class="panel-body">
        	<form class="form-vertical" id="category-form">
    			<div class="form-group">
        			<label for="category-id">Category</label>
        			<div class="row">
        				<div class="col-sm-4">
		        			<?php echo e(Form::select( 'category_id', $categories, Request::input('category_id'), [ 'class' => 'form-control', 'id'=>'categories' ] )); ?>

	        			</div>
        			</div>
        		</div>
        	</form>
            <?php if( !$products->total()  ): ?>
				<?php if( App\Product::count() ): ?>
					<h5>This category has no products</h5>
				<?php else: ?>
					<h5>
						No Products
						<?php if( Auth::user()->is_admin ): ?>
							<a href="<?php echo e(route( 'admin.products.create' )); ?>">Add Products</a>
						<?php else: ?>
							<small>Tell system admin to add products</small>
						<?php endif; ?>
					</h5>
				<?php endif; ?>
            <?php elseif( $products->isEmpty() ): ?>
				<h5> Out of total pages </h5>
            <?php else: ?>
	            <?php $__currentLoopData = $products->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products_row): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<div class="row">
						<?php $__currentLoopData = $products_row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<section class="col-sm-4">
								<div class="thumbnail">
									<img src="<?php echo e(URL::asset( '/images/products/default.png' )); ?>" alt="">
									<div class="caption">
										<h5><?php echo e($product->name); ?></h5>
										<p class="padding-l10">
											<?php echo e($product->short_description); ?>

										</p>
										<h6>
											Price: <span class="badge badge-warning"><?php echo e($product->price); ?> L.E.</span>
										</h6>
										<?php if( $product->discount_percent ): ?>
											<h6>
												Discount: <?php echo e($product->discount_percent); ?>%</span> <span class="badge badge-danger"><?php echo e($product->discount); ?> L.E.</span>
											</h6>
											<h6>
												Net Price: </span> <span class="badge badge-success"><?php echo e($product->price - $product->discount); ?> L.E.</span>
											</h6>
										<?php endif; ?>
										<h6>
											<?php if( $product->instock_quantity  ): ?>
												in stock: <span class="badge green-bg"><?php echo e($product->instock_quantity); ?></span>
											<?php else: ?>
												<span class="badge red-bg">out of stock</span>
											<?php endif; ?>
										</h6>
										<a href="#" class="btn btn-sm btn-block <?php echo e($product->instock_quantity ? 'btn-success' : 'btn-danger disabled'); ?> add-to-basket <?php echo e(isset( $order->data[ $product->id ] ) ? ' disabled' : ''); ?>" data-id="<?php echo e($product->id); ?>" data-instock="<?php echo e($product->instock_quantity); ?>">
											<?php echo e(isset( $order->data[ $product->id ] ) ? 'In Basket' : 'Add To Basket'); ?>

											<i class="fa fa-shopping-cart font-size-p2"></i>
										</a>
									</div>
									
								</div>
							</section>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</div>
	            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	        <?php endif; ?>

	        <?php if( $products->hasPages() ): ?>
				<section class="">
					<?php echo e($products->links()); ?>

				</section>
	        <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>