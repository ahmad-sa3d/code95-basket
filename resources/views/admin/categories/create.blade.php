@extends( 'layouts.admin_master' )

@section( 'title', 'Create Category' )

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
					<h4 class="panel-title">Create New Category</h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="{{ route('admin.categories.index') }}" class="no-underline" data-toggle="tooltip" title="all categories">
							<span class="fa fa-sitemap"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			{{ Form::open( [
					'route' => [ 'admin.categories.store' ],
					'method' => 'POST',
					'class' => 'form-horizontal',
				] ) }}
				
				<div class="form-group{{ $errors->has( 'title' ) ? ' has-error' : '' }}">
					<label for="title" class="control-label col-xs-12 col-sm-2">Category Title</label>
					<div class="col-xs-12 col-sm-10">
						{{ Form::text( 'title', old('title'), [ 'class'=>'form-control', 'id' => 'title', 'required', 'autofocus', 'tabindex'=>1 ] ) }}
						@if( $errors->has( 'title' ) )
							<p class="help-block">
								{{ $errors->first('title') }}
							</p>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has( 'parent_id' ) ? ' has-error' : '' }}">
					<label for="parent_id" class="control-label col-xs-12 col-sm-2">Parent Category</label>
					<div class="col-xs-12 col-sm-10">
						{{ Form::select( 'parent_id', $parents, old( 'parent_id', 0 ), [ 'class'=>'form-control', 'id' => 'parent_id', 'required', 'autofocus', 'tabindex'=>1 ] ) }}
						@if( $errors->has( 'parent_id' ) )
							<p class="help-block">
								{{ $errors->first('parent_id') }}
							</p>
						@endif
					</div>
				</div>


				<div class="form-group{{ $errors->has( 'description' ) ? ' has-error' : '' }}">
					<label for="description" class="control-label col-xs-12 col-sm-2">Description</label>
					<div class="col-xs-12 col-sm-10">
						{{ Form::textarea( 'description', old( 'description' ), [ 'class'=>'form-control', 'id' => 'description', 'tabindex'=>3, 'required' ] ) }}
						@if( $errors->has( 'description' ) )
							<p class="help-block">
								{{ $errors->first('description') }}
							</p>
						@endif
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-success" type="submit" tabindex=6>Save</button>
					</div>
				</div>

			{{ Form::close() }}
			
		</div>
	</div>

@endsection