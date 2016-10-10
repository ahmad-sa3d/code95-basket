@extends( 'layouts.admin_master' )

@section( 'title', 'System Products' )

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">Products</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-8">
					<h5>All Products <span class="badge green-bg">{{ $products->total() }}</span></h5>
				</div>
				<div class="col-xs-4">
					<p class="pull-right">
						<a href="{{ route('admin.products.create') }}" class="no-underline" data-toggle="tooltip" title="New Product">
							<span class="glyphicon glyphicon-plus"></span>
							<span class="fa fa-cubes"></span>
						</a>
					</p>
				</div>
			</div>
			
		</div>
		@if( !$products->isEmpty() )
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
						@foreach( $products as $user )
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->instock_quantity }}</td>
								<td>{{ $user->price }}</td>
								<td>{{ $user->discount_percent ?  $user->discount_percent: 0 }}</td>
								<td>
									<a href="{{ route('admin.products.show', $user->id) }}" data-toggle="tooltip" title="Show {{ $user->username }}" class="no-underline">
										<span class="glyphicon glyphicon-user"></span>
									</a>
									<a href="{{ route('admin.products.edit', $user->id) }}" data-toggle="tooltip" title="Edit {{ $user->username }}" class="margin-0-5 no-underline">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a href="{{ route('admin.products.delete', $user->id) }}" data-toggle="tooltip" title="Delete {{ $user->username }}" class="no-underline">
										<span class="glyphicon glyphicon-trash text-danger"></span>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
					@if( $products->hasPages() )
						<tfoot>
							<tr>
								<td colspan="6" class="text-left">
									{{ $products->links() }}
								</td>
							</tr>
						</tfoot>
					@endif
				</table>
			</div>
		@endif
	</div>
@endsection