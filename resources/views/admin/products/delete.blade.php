@extends( 'layouts.admin_master' )

@section( 'title', 'Delete Product ' . $product->name )

@push( 'styles' )
@endpush

@push( 'scripts' )
@endpush

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
					<h4 class="panel-title "><i class="text-danger fa fa-trash padding-r5"></i> {{ $product->name }}</h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="{{ route('admin.products.show', $product->id) }}" class="no-underline" data-toggle="tooltip" title="show">
							<span class="glyphicon glyphicon-eye-open"></span>
						</a>

						<a href="{{ route('admin.products.edit', $product->id) }}" class="no-underline margin-0-5" data-toggle="tooltip" title="edit">
							<span class="glyphicon glyphicon-edit"></span>
						</a>

						<a href="{{ route('admin.products.index') }}" class="no-underline" data-toggle="tooltip" title="all products">
							<span class="fa fa-cubes"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<h4>Deleting Status :</h4>
			<blockquote class="text-muted">
				Be aware that deleting products may affect on the application as it might have related data like sales and invoices
				we recommended you not to delete Any product if it has related data.
			</blockquote>

			<form class="form-inline" method="POST" action="{{ route( 'admin.products.destroy', $product->id ) }}">
				{{ csrf_field() }}
				{{ method_field( 'DELETE' ) }}

				<button class="btn btn-danger btn-sm">Confirm Delete</button>
			</form>
		</div>
	</div>
	
@endsection