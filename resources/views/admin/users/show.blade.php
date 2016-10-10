@extends( 'layouts.admin_master' )

@section( 'title', 'User ' . $user->username )

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
						<h4 class="panel-title">{{ $user->username }}</h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="{{ route('admin.users.edit', $user->id) }}" class="no-underline" data-toggle="tooltip" title="edit">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
						<a href="{{ route('admin.users.delete', $user->id) }}" class="no-underline margin-0-5" data-toggle="tooltip" title="delete">
							<span class="glyphicon glyphicon-trash text-danger"></span>
						</a>
						<a href="{{ route('admin.users.index') }}" class="no-underline" data-toggle="tooltip" title="all users">
							<span class="fa fa-group"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<dl>
				<div class="data-row">
					<dt class="data-name">User name</dt>
					<dd class="data-value">{{ $user->username }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">User Id</dt>
					<dd class="data-value">{{ $user->id }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Is Admin</dt>
					<dd class="data-value">{{ $user->is_admin ? 'Yes' : 'No' }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Is Active</dt>
					<dd class="data-value">{{ $user->is_active ? 'Yes' : 'No' }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Created At</dt>
					<dd class="data-value">{{ $user->created_at->toDayDateTimeString() }}</dd>
				</div>
				<div class="data-row">
					<dt class="data-name">Last Update</dt>
					<dd class="data-value">{{ $user->updated_at->toDayDateTimeString() }}</dd>
				</div>
			</dl>
		</div>
	</div>
@endsection