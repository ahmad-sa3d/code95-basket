@extends( 'layouts.admin_master' )

@section( 'title', 'Delete Category ' . $category->title )

@push( 'styles' )
@endpush

@push( 'scripts' )
@endpush

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
					<h4 class="panel-title "><i class="text-danger fa fa-trash padding-r5"></i> {{ $category->title }}</h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="{{ route('admin.categories.edit', $category->id) }}" class="no-underline" data-toggle="tooltip" title="edit">
							<span class="glyphicon glyphicon-edit"></span>
						</a>

						<a href="{{ route('admin.categories.show', $category->id) }}" class="no-underline margin-0-5" data-toggle="tooltip" title="Back To Category">
							<span class="fa fa-eye"></span>
						</a>

						<a href="{{ route('admin.categories.index') }}" class="no-underline" data-toggle="tooltip" title="all categories">
							<span class="fa fa-sitemap"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<h4>Deleting Status :</h4>
			{{-- <blockquote class="text-muted"> --}}
					<table class="table table-bordered table-stripped table-hover">
						<thead>
							<tr>
								<th>Dependency</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Sub Categories Count</td>
								<td>{{ $category->children->count() }}</td>
							</tr>
							<tr>
								<td>Category Products Count</td>
								<td>{{ $category->products->count() }}</td>
							</tr>
						</tbody>
						<tfoot>
							<tr class="{{ $category->isSafelyDelete() ? 'bg-success' : 'bg-danger' }}">
								<th>Safe To delete</th>
								<th>{{ $category->isSafelyDelete() ? 'Yes' : 'No' }}</th>
							</tr>
						</tfoot>
					</table>
			{{-- </blockquote> --}}

			<form class="form-inline" method="POST" action="{{ route( 'admin.categories.destroy', $category->id ) }}">
				{{ csrf_field() }}
				{{ method_field( 'DELETE' ) }}

				<button class="btn btn-danger btn-sm">Confirm Delete</button>
			</form>
		</div>
	</div>
	
@endsection