@extends( 'layouts.admin_master' )

@section( 'title', 'Product ' . $product->name )

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
						<h4 class="panel-title">{{ $product->name }}</h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="{{ route('admin.products.edit', $product->id) }}" class="no-underline" data-toggle="tooltip" title="edit">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
						<a href="{{ route('admin.products.delete', $product->id) }}" class="no-underline margin-0-5" data-toggle="tooltip" title="delete">
							<span class="glyphicon glyphicon-trash text-danger"></span>
						</a>
						<a href="{{ route('admin.products.index') }}" class="no-underline" data-toggle="tooltip" title="all products">
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
					<dd class="data-value">{{ $product->name }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Id</dt>
					<dd class="data-value">{{ $product->id }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Price</dt>
					<dd class="data-value">
						{{ $product->price }} <span class="badge yellow-bg font-size-m2"> L.E. </span>
						@if( $product->discount_percent )
							After Discount <span class="badge green-bg font-size-m2">{{ $product->price - $product->discount }} L.E.</span>
						@endif
					</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Instock Quantity</dt>
					<dd class="data-value">{{ $product->instock_quantity }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Discount percent</dt>
					<dd class="data-value">{!! $product->discount_percent ? $product->discount_percent . ' % ' . 'Equals <span class="badge green-bg">' . $product->discount . ' L.E.</span>' : 'No Discount For This Product' !!}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Categories</dt>
					<dd class="data-value">
						@foreach( $product->categories as $category )
							<a class="btn btn-xs btn-warning" href="{{ route( 'admin.categories.show', $category->id ) }}">{{ $category->title }}</a>
						@endforeach
					</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Created At</dt>
					<dd class="data-value">{{ $product->created_at->toDayDateTimeString() }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Last Update</dt>
					<dd class="data-value">{{ $product->updated_at->toDayDateTimeString() }}</dd>
				</div>
			</dl>
		</div>
	</div>
@endsection