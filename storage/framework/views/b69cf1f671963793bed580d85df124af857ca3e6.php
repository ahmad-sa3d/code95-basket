<?php $__env->startSection( 'title', 'Dashboard' ); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title"><span class="label label-success">Sales</span> <span class="fa fa-calendar margin-r5"></span><?php echo e($now->format( 'l, j M Y' )); ?></h4>	
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading no-margin">
							<div class="row">
								<div class="panel-title col-xs-5">
									<span class="fa fa-shopping-cart lg-text"></span>
									<span class="badge"><?php echo e($sold_pro_count = $sales->sum('quantity')); ?></span>
								</div>
								<div class="panel-title pull-right col-xs-7 text-right">
									<span class="md-text">Today Sales</span>
								</div>
							</div>
								
						</div>
						<div class="panel-body">
							<h4>
								<span class="valign-middle label label-default">
									# Invoices: <?php echo e($invoices->count()); ?>

								</span>
								<i class="fa fa-arrow-right"></i>
								<span class="valign-middle label label-success">
									# Sales: <?php echo e($invoices->sum()); ?>

								</span>
								<i class="fa fa-arrow-right"></i>
								<span class="valign-middle label label-default">
									# Quantity: <?php echo e($sold_pro_count); ?>

								</span>
								<i class="fa fa-arrow-right"></i>
								<span class="valign-middle label label-success">
									<?php echo e(number_format( $sales->sum( function( $sale ){ return $sale->quantity * ( $sale->unit_price - $sale->unit_discount); } ), 2 )); ?> L.E.
								</span>
							</h4>
						</div>
						<?php if( $top_seller_sales ): ?>
							<table class="table">
								<thead>
									<tr>
										<th class="text-center">Top Seller</th>
										<th class="text-center"># Sales</th>
										<th class="text-center">Sales Money</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="text-center">
											<a href="<?php echo e(route( 'admin.users.show', $top_seller_sales->first()->user->id )); ?>" class="btn btn-xs btn-success">
												<?php echo e($top_seller_sales->first()->user->username); ?>

											</a>
										</td>
										<td class="text-center">
											<span class="badge "><?php echo e($top_seller_sales->count()); ?></span>
										</td>
										<td class="text-center">
											<span class="badge">
												<?php echo e(number_format( $top_seller_sales->sum( function( $sale ){ return $sale->quantity * ( $sale->unit_price - $sale->unit_discount); } ), 2 )); ?> L.E.
											</span>
										</td>
									</tr>
								</tbody>
							</table>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-danger">
						<div class="panel-heading no-margin">
							<div class="row">
								<div class="panel-title col-xs-5">
									<span class="fa fa-cubes lg-text"></span>
									<span class="badge"><?php echo e($product_sale_count = $product_sale->count()); ?></span>
								</div>
								<div class="panel-title pull-right col-xs-7 text-right">
									<span class="md-text">Products</span>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<h4 class=""><span class="valign-middle label label-warning"><?php echo e($product_sale_count); ?></span> Diffrent Products Which Sold Tody</h4>
						</div>
						<?php if( !$product_sale->isEmpty() ): ?>
							<table class="table">
								<thead>
									<tr>
										<th class="text-center">Top Product</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Sales Money</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $product_sale->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_coll): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<tr>
											<td class="text-center">
												<a href="<?php echo e(route( 'admin.products.show', $product_coll->first()->product->id )); ?>" class="btn btn-xs btn-warning">
													<?php echo e($product_coll->first()->product->name); ?>

												</a>
											</td>
											<td class="text-center"><span class="badge "><?php echo e($product_coll->sum( 'quantity' )); ?></span></td>
											<td class="text-center">
												<span class="badge">
													<?php echo e(number_format( $product_coll->sum( function( $sale ){ return $sale->quantity * ( $sale->unit_price - $sale->unit_discount ) ; } ), 2 )); ?> L.E.
												</span>
											</td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								</tbody>
							</table>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<span class="label label-danger">Critical Products </span>
			</h4>	
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-danger">
						<div class="panel-heading no-margin">
							<div class="row">
								<div class="panel-title col-xs-5">
									<span class="fa fa-cubes lg-text"></span>
									<span class="badge"><?php echo e($outofstock_products->count()); ?></span>
								</div>
								<div class="panel-title pull-right col-xs-7 text-right">
									<span class="md-text">Out Of Stock</span>
								</div>
							</div>
								
						</div>
						<div class="panel-body">
							
							<?php if( $outofstock_products->isEmpty() ): ?>
								<h4>All Products Are In Stock</h4>
						</div>
							
							<?php else: ?>
						</div>
								<table class="table">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Product Name</th>
											<th class="text-center">Link</th>
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $outofstock_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<tr>
												<td class="text-center"><?php echo e($loop->iteration); ?></td>
												<td class="text-center"><?php echo e($product->name); ?></td>
												<td class="text-center">
													<a class="no-underline" href="<?php echo e(route( 'admin.products.show', $product->id )); ?>" data-toggle="tooltip" title="Go">
														<span class="fa fa-arrow-right"></span>
													</a>
												</td>
											</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									</tbody>
								</table>
							<?php endif; ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-warning">
						<div class="panel-heading no-margin">
							<div class="row">
								<div class="panel-title col-xs-5">
									<span class="fa fa-cubes lg-text"></span>
									<span class="badge"><?php echo e($instock_critical_products->count()); ?></span>
								</div>
								<div class="panel-title pull-right col-xs-7 text-right">
									<span class="md-text">Critical Limit</span>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<?php if( $instock_critical_products->isEmpty() ): ?>
								<h4> No Products Reached Critical Limit </h4>
						</div>
							<?php else: ?>
								<h4>
									<span class="valign-middle label label-danger"><?php echo e($instock_critical_products->count()); ?></span>
									Product Reached Critical Limit
								</h4>
						</div>
								<table class="table">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Name</th>
											<th class="text-center">Quantity</th>
											<th class="text-center">Link</th>
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $instock_critical_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<tr>
												<td class="text-center"><?php echo e($loop->iteration); ?></td>
												<td class="text-center"><?php echo e($product->name); ?></td>
												<td class="text-center"><?php echo e($product->instock_quantity); ?></td>
												<td class="text-center">
													<a href="<?php echo e(route( 'admin.products.show', $product->id )); ?>" data-toggle="tooltip" title="Go">
														<span class="fa fa-arrow-right"></span>
													</a>
												</td>
											</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									</tbody>
								</table>
							<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
			
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>