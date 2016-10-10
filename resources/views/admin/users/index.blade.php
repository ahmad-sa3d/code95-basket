@extends( 'layouts.admin_master' )

@section( 'title', 'System Users' )

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">All Users</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-8">
					<h5>All System Users <span class="badge green-bg">{{ $users->total() }}</span></h5>
				</div>
				<div class="col-xs-4">
					<p class="pull-right">
						<a href="{{ route('admin.users.create') }}" class="no-underline" data-toggle="tooltip" title="Create New User">
							<span class="glyphicon glyphicon-plus"></span>
							<span class="glyphicon glyphicon-user"></span>
						</a>
					</p>
				</div>
			</div>
			
		</div>
		@if( !$users->isEmpty() )
			<div class="table-responsive">
				<table class="table table-bordered text-center">
					<thead>
						<tr>
							<th class="col-xs-1 text-center">#</th>
							<th class="text-center">Username</th>
							<th class="text-center">Is Admin</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $users as $user )
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $user->username }}</td>
								<td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
								<td>
									<a href="{{ route('admin.users.show', $user->id) }}" data-toggle="tooltip" title="Show {{ $user->username }}" class="no-underline">
										<span class="glyphicon glyphicon-user"></span>
									</a>
									<a href="{{ route('admin.users.edit', $user->id) }}" data-toggle="tooltip" title="Edit {{ $user->username }}" class="margin-0-5 no-underline">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a href="{{ route('admin.users.delete', $user->id) }}" data-toggle="tooltip" title="Delete {{ $user->username }}" class="no-underline">
										<span class="glyphicon glyphicon-trash text-danger"></span>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
					@if( $users->hasPages() )
						<tfoot>
							<tr>
								<td colspan="4" class="text-left">
									{{ $users->links() }}
								</td>
							</tr>
						</tfoot>
					@endif
				</table>
			</div>
		@endif
	</div>
@endsection