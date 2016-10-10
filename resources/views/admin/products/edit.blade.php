@extends( 'layouts.admin_master' )

@section( 'title', 'Edit Product ' . $product->name )

@push( 'styles' )
	{{ Html::style( '/css/selectize.min.css' ) }}
@endpush

@push( 'scripts' )
	{{ Html::script( '/js/selectize.min.js' ) }}
	<script>
		$('select').selectize();
	</script>
@endpush

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
					<h4 class="panel-title"><i class="fa fa-edit padding-r5"></i>{{ $product->name }}</h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="{{ route('admin.products.show', $product->id) }}" class="no-underline" data-toggle="tooltip" title="show">
							<span class="glyphicon glyphicon-eye-open"></span>
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
			{{ Form::model( $product, [
					'route' => [ 'admin.products.update', $product->id ],
					'method' => 'PATCH',
					'class' => 'form-horizontal',
				] ) }}
				
				<div class="form-group{{ $errors->has( 'name' ) ? ' has-error' : '' }}">
					<label for="name" class="control-label col-xs-12 col-sm-2">Product Name</label>
					<div class="col-xs-12 col-sm-10">
						{{ Form::text( 'name', null, [ 'class'=>'form-control', 'id' => 'name', 'required', 'autofocus', 'tabindex'=>1 ] ) }}
						@if( $errors->has( 'name' ) )
							<p class="help-block">
								{{ $errors->first('name') }}
							</p>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has( 'instock_quantity' ) ? ' has-error' : '' }}">
					<label for="instock-quantity" class="control-label col-xs-12 col-sm-2">Instock Quantity</label>
					<div class="col-xs-12 col-sm-10">
						{{ Form::number( 'instock_quantity', null, [ 'class'=>'form-control', 'id' => 'instock-quantity', 'required', 'tabindex'=>2, 'min'=>0, 'step'=>1 ] ) }}
						@if( $errors->has( 'instock_quantity' ) )
							<p class="help-block">
								{{ $errors->first('instock_quantity') }}
							</p>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has( 'price' ) ? ' has-error' : '' }}">
					<label for="price" class="control-label col-xs-12 col-sm-2">Price</label>
					<div class="col-xs-12 col-sm-10">
						<div class="input-group col-xs-12">
							{{ Form::number( 'price', null, [ 'class'=>'form-control', 'id' => 'price', 'required', 'tabindex'=>3, 'min'=>0, 'step'=>.25 ] ) }}
							<span class="input-group-addon width-50">L.E.</span>
						</div>
						@if( $errors->has( 'price' ) )
							<p class="help-block">
								{{ $errors->first('price') }}
							</p>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has( 'discount_percent' ) ? ' has-error' : '' }}">
					<label for="discount-pct" class="control-label col-xs-12 col-sm-2">Discount</label>
					<div class="col-xs-12 col-sm-10">
						<div class="input-group col-xs-12">
							{{ Form::number( 'discount_percent', null, [ 'class'=>'form-control', 'id' => 'discount-pct', 'tabindex'=>4, 'min'=>0, 'step'=>1, 'max'=>100 ] ) }}
							<span class="input-group-addon width-50">%</span>
						</div>
						@if( $errors->has( 'discount_percent' ) )
							<p class="help-block">
								{{ $errors->first('discount_percent') }}
							</p>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has( 'categories' ) ? ' has-error' : '' }}">
					<label for="categories" class="control-label col-xs-12 col-sm-2">Categories</label>
					<div class="col-xs-12 col-sm-10">
						{{ Form::select( 'categories', $categories, $product->categories->pluck('id')->all(), [ 'name' => 'categories[]', 'multiple', 'class'=>'form-control', 'id' => 'categories', 'tabindex'=>5 ] ) }}
						@if( $errors->has( 'categories' ) )
							<p class="help-block">
								{{ $errors->first('categories') }}
							</p>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has( 'description' ) ? ' has-error' : '' }}">
					<label for="description" class="control-label col-xs-12 col-sm-2">Description</label>
					<div class="col-xs-12 col-sm-10">
						{{ Form::textarea( 'description', null, [ 'class'=>'form-control', 'id' => 'description', 'tabindex'=>6, 'required' ] ) }}
						@if( $errors->has( 'description' ) )
							<p class="help-block">
								{{ $errors->first('description') }}
							</p>
						@endif
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-success" type="submit" tabindex=7>Save</button>
					</div>
				</div>

			{{ Form::close() }}
			
		</div>
	</div>

@endsection