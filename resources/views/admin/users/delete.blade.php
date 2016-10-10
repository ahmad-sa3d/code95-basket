@extends( 'layouts.admin_master' )

@section( 'title', 'Delete User ' . $user->username )

@push( 'styles' )
@endpush

@push( 'scripts' )
@endpush

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
					<h4 class="panel-title "><i class="text-danger fa fa-trash padding-r5"></i> {{ $user->username }}</h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="{{ route('admin.users.edit', $user->id) }}" class="no-underline" data-toggle="tooltip" title="edit">
							<span class="glyphicon glyphicon-edit"></span>
						</a>

						<a href="{{ route('admin.users.show', $user->id) }}" class="no-underline margin-0-5" data-toggle="tooltip" title="Back To user">
							<span class="fa fa-user"></span>
						</a>

						<a href="{{ route('admin.users.index') }}" class="no-underline" data-toggle="tooltip" title="all users">
							<span class="fa fa-group"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<h4>Deleting User :</h4>
			<blockquote class="text-muted">
					Deleting user might affect application data as user might have related actions
					We Recommended You To <code>deactivate</code> User Instead of Delete
			</blockquote>

			<form class="form-inline" method="POST" action="{{ route( 'admin.users.destroy', $user->id ) }}">
				{{ csrf_field() }}
				{{ method_field( 'DELETE' ) }}

				<button class="btn btn-danger btn-sm">Confirm Delete</button>
			</form>
		</div>
	</div>
	
@endsection