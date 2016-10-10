@extends('layouts.master')

@section( 'title', 'Shop Name' )

@push( 'styles' )
	{{ Html::style( '/css/selectize.min.css' ) }}
@endpush

@push( 'scripts' )
	{{ Html::script( '/js/selectize.min.js' ) }}
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
		orderItems = JSON.parse( '{!! ( $order ) ? json_encode( $order->items->map( function($item){ return $item["quantity"]; } ), JSON_FORCE_OBJECT ) : "{}" !!}' );
	</script>
	{{ Html::script( '/js/basket.min.js' ) }}
@endpush

@section('content')
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
		        			{{ Form::select( 'category_id', $categories, Request::input('category_id'), [ 'class' => 'form-control', 'id'=>'categories' ] ) }}
	        			</div>
        			</div>
        		</div>
        	</form>
            @if( !$products->total()  )
				@if( App\Product::count() )
					<h5>This category has no products</h5>
				@else
					<h5>
						No Products
						@if( Auth::user()->is_admin )
							<a href="{{ route( 'admin.products.create' ) }}">Add Products</a>
						@else
							<small>Tell system admin to add products</small>
						@endif
					</h5>
				@endif
            @elseif( $products->isEmpty() )
				<h5> Out of total pages </h5>
            @else
	            @foreach( $products->chunk(3) as $products_row )
					<div class="row">
						@foreach( $products_row as $product )
							<section class="col-sm-4">
								<div class="thumbnail">
									<img src="{{ URL::asset( '/images/products/default.png' ) }}" alt="">
									<div class="caption">
										<h5>{{ $product->name }}</h5>
										<p class="padding-l10">
											{{ $product->short_description }}
										</p>
										<h6>
											Price: <span class="badge badge-warning">{{ $product->price }} L.E.</span>
										</h6>
										@if( $product->discount_percent )
											<h6>
												Discount: {{ $product->discount_percent }}%</span> <span class="badge badge-danger">{{ $product->discount }} L.E.</span>
											</h6>
											<h6>
												Net Price: </span> <span class="badge badge-success">{{ $product->price - $product->discount }} L.E.</span>
											</h6>
										@endif
										<h6>
											@if( $product->instock_quantity  )
												in stock: <span class="badge green-bg">{{ $product->instock_quantity }}</span>
											@else
												<span class="badge red-bg">out of stock</span>
											@endif
										</h6>
										<a href="#" class="btn btn-sm btn-block {{ $product->instock_quantity ? 'btn-success' : 'btn-danger disabled' }} add-to-basket {{ isset( $order->data[ $product->id ] ) ? ' disabled' : '' }}" data-id="{{ $product->id }}" data-instock="{{ $product->instock_quantity }}">
											{{ isset( $order->data[ $product->id ] ) ? 'In Basket' : 'Add To Basket' }}
											<i class="fa fa-shopping-cart font-size-p2"></i>
										</a>
									</div>
									
								</div>
							</section>
						@endforeach
					</div>
	            @endforeach
	        @endif

	        @if( $products->hasPages() )
				<section class="">
					{{ $products->links() }}
				</section>
	        @endif
        </div>
    </div>
@endsection
