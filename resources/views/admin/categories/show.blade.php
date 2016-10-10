@extends( 'layouts.admin_master' )

@section( 'title', 'Category ' . $category->title )

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
						<h4 class="panel-title">{{ $category->title }}</h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="{{ route('admin.categories.edit', $category->id) }}" class="no-underline" data-toggle="tooltip" title="edit">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
						<a href="{{ route('admin.categories.delete', $category->id) }}" class="no-underline margin-0-5" data-toggle="tooltip" title="delete">
							<span class="glyphicon glyphicon-trash text-danger"></span>
						</a>
						<a href="{{ route('admin.categories.index') }}" class="no-underline" data-toggle="tooltip" title="all categories">
							<span class="fa fa-sitemap"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<dl>
				<div class="data-row">
					<dt class="data-name">Title</dt>
					<dd class="data-value">{{ $category->title }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Id</dt>
					<dd class="data-value">{{ $category->id }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Description</dt>
					<dd class="data-value">{{ $category->description }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Products</dt>
					<dd class="data-value">{{ $category->products->count() }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Parent category</dt>
					<dd class="data-value">
						@if( $category->parent )
							<a href="{{ route( 'admin.categories.show', $category->parent->id ) }}" class="btn btn-info btn-xs">{{ $category->parent->title }}</a>
						@else
							---
						@endif
					</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Child categories</dt>
					<dd class="data-value">
						@if( $category->childs->isEmpty() )
							No Childs For This category
						@else
							@foreach( $category->childs as $child )
								<a href="{{ route( 'admin.categories.show', $child->id ) }}" class="btn btn-warning btn-xs">{{ $child->title }}</a>
							@endforeach
						@endif
					</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Created At</dt>
					<dd class="data-value">{{ $category->created_at->toDayDateTimeString() }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Last Update</dt>
					<dd class="data-value">{{ $category->updated_at->toDayDateTimeString() }}</dd>
				</div>
			</dl>
			<hr>
			@if( !$category->childs->isEmpty() )
				<h5 class="text-primary text-center">List all Categories in Hirearchy</h5>
				{{-- <div class="table-responsive"> --}}
					<ul class="list-group">
						@include( 'admin.categories.partials.category' )
					</ul>
				{{-- </div> --}}
			@endif
		</div>
	</div>
@endsection