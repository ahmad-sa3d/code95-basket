@extends( 'layouts.admin_master' )

@section( 'title', 'System Categories' )

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">All Categories</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-8">
					<h5>All System Categories <span class="badge green-bg">{{ App\Category::count() }}</span></h5>
				</div>
				<div class="col-xs-4">
					<p class="pull-right">
						<a href="{{ route('admin.categories.create') }}" class="no-underline" data-toggle="tooltip" title="New Category">
							<span class="glyphicon glyphicon-plus"></span>
							<span class="fa fa-sitemap"></span>
						</a>
					</p>
				</div>
			</div>

			
			@if( !$categories->isEmpty() )
				<h5 class="text-primary text-center">List all Categories in Hirearchy</h5>
				{{-- <div class="table-responsive"> --}}
					<ul class="list-group">
						@each( 'admin.categories.partials.category', $categories, 'category' )
					</ul>
				{{-- </div> --}}
			@endif
			
		</div>
	</div>
@endsection