@extends( 'layouts.admin_master' )

@section( 'title', 'Dashboard' )

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title"><span class="label label-success">Sales</span> <span class="fa fa-calendar margin-r5"></span>{{ $now->format( 'l, j M Y' ) }}</h4>	
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading no-margin">
							<div class="row">
								<div class="panel-title col-xs-5">
									<span class="fa fa-shopping-cart lg-text"></span>
									<span class="badge">{{ $sold_pro_count = $sales->sum('quantity') }}</span>
								</div>
								<div class="panel-title pull-right col-xs-7 text-right">
									<span class="md-text">Today Sales</span>
								</div>
							</div>
								
						</div>
						<div class="panel-body">
							<h4>
								<span class="valign-middle label label-default">
									# Invoices: {{ $invoices->count() }}
								</span>
								<i class="fa fa-arrow-right"></i>
								<span class="valign-middle label label-success">
									# Sales: {{ $invoices->sum() }}
								</span>
								<i class="fa fa-arrow-right"></i>
								<span class="valign-middle label label-default">
									# Quantity: {{ $sold_pro_count }}
								</span>
								<i class="fa fa-arrow-right"></i>
								<span class="valign-middle label label-success">
									{{ number_format( $sales->sum( function( $sale ){ return $sale->quantity * ( $sale->unit_price - $sale->unit_discount); } ), 2 ) }} L.E.
								</span>
							</h4>
						</div>
						@if( $top_seller_sales )
							<div class="table-responsive">
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
												<a href="{{ route( 'admin.users.show', $top_seller_sales->first()->user->id ) }}" class="btn btn-xs btn-success">
													{{ $top_seller_sales->first()->user->username }}
												</a>
											</td>
											<td class="text-center">
												<span class="badge ">{{ $top_seller_sales->count() }}</span>
											</td>
											<td class="text-center">
												<span class="badge">
													{{ number_format( $top_seller_sales->sum( function( $sale ){ return $sale->quantity * ( $sale->unit_price - $sale->unit_discount); } ), 2 ) }} L.E.
												</span>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						@endif
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-danger">
						<div class="panel-heading no-margin">
							<div class="row">
								<div class="panel-title col-xs-5">
									<span class="fa fa-cubes lg-text"></span>
									<span class="badge">{{ $product_sale_count = $product_sale->count() }}</span>
								</div>
								<div class="panel-title pull-right col-xs-7 text-right">
									<span class="md-text">Products</span>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<h4 class=""><span class="valign-middle label label-warning">{{ $product_sale_count }}</span> Diffrent Products Which Sold Today</h4>
						</div>
						@if( !$product_sale->isEmpty() )
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th class="text-center">Top Product</th>
											<th class="text-center">Quantity</th>
											<th class="text-center">Sales Money</th>
										</tr>
									</thead>
									<tbody>
										@foreach( $product_sale->take(5) as $product_coll )
											<tr>
												<td class="text-center">
													<a href="{{ route( 'admin.products.show', $product_coll->first()->product->id ) }}" class="btn btn-xs btn-warning">
														{{ $product_coll->first()->product->name }}
													</a>
												</td>
												<td class="text-center"><span class="badge ">{{ $product_coll->sum( 'quantity' ) }}</span></td>
												<td class="text-center">
													<span class="badge">
														{{ number_format( $product_coll->sum( function( $sale ){ return $sale->quantity * ( $sale->unit_price - $sale->unit_discount ) ; } ), 2 ) }} L.E.
													</span>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						@endif
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
									<span class="badge">{{ $outofstock_products->count() }}</span>
								</div>
								<div class="panel-title pull-right col-xs-7 text-right">
									<span class="md-text">Out Of Stock</span>
								</div>
							</div>
								
						</div>
						<div class="panel-body">
							
							@if( $outofstock_products->isEmpty() )
								<h4>All Products Are In Stock</h4>
						</div>
							
							@else
						</div>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Product Name</th>
											<th class="text-center">Link</th>
										</tr>
									</thead>
									<tbody>
										@foreach( $outofstock_products as $product )
											<tr>
												<td class="text-center">{{ $loop->iteration }}</td>
												<td class="text-center">{{ $product->name }}</td>
												<td class="text-center">
													<a class="no-underline" href="{{ route( 'admin.products.show', $product->id ) }}" data-toggle="tooltip" title="Go">
														<span class="fa fa-arrow-right"></span>
													</a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							@endif
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-warning">
						<div class="panel-heading no-margin">
							<div class="row">
								<div class="panel-title col-xs-5">
									<span class="fa fa-cubes lg-text"></span>
									<span class="badge">{{ $instock_critical_products->count() }}</span>
								</div>
								<div class="panel-title pull-right col-xs-7 text-right">
									<span class="md-text">Critical Limit</span>
								</div>
							</div>
						</div>
						<div class="panel-body">
							@if( $instock_critical_products->isEmpty() )
								<h4> No Products Reached Critical Limit </h4>
						</div>
							@else
								<h4>
									<span class="valign-middle label label-danger">{{ $instock_critical_products->count() }}</span>
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
										@foreach( $instock_critical_products as $product )
											<tr>
												<td class="text-center">{{ $loop->iteration }}</td>
												<td class="text-center">{{ $product->name }}</td>
												<td class="text-center">{{ $product->instock_quantity }}</td>
												<td class="text-center">
													<a href="{{ route( 'admin.products.show', $product->id ) }}" data-toggle="tooltip" title="Go">
														<span class="fa fa-arrow-right"></span>
													</a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							@endif
					</div>
				</div>
			</div>
		</div>
	</div>
			
@endsection