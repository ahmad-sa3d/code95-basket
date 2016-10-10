@extends( 'layouts.admin_master' )

@section( 'title', 'System Users' )

@push( 'styles' )
	{{ Html::style( '/css/rcswitcher.min.css' ) }}
@endpush

@push( 'scripts' )
	{{ Html::script( '/js/rcswitcher.min.js' ) }}
@endpush

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
					<h4 class="panel-title"><i class="fa fa-edit padding-r5"></i>{{ $user->username }}</h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="{{ route('admin.users.show', $user->id) }}" class="no-underline" data-toggle="tooltip" title="show">
							<span class="glyphicon glyphicon-eye-open"></span>
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
			{{ Form::model( $user, [
					'route' => [ 'admin.users.update', $user->id ],
					'method' => 'PATCH',
					'class' => 'form-horizontal',
				] ) }}
				
				<div class="form-group{{ $errors->has( 'username' ) ? ' has-error' : '' }}">
					<label for="username" class="control-label col-xs-12 col-sm-2">User Name</label>
					<div class="col-xs-12 col-sm-10">
						{{ Form::text( 'username', null, [ 'class'=>'form-control', 'id' => 'username', 'required', 'autofocus', 'tabindex'=>1 ] ) }}
						@if( $errors->has( 'username' ) )
							<p class="help-block">
								{{ $errors->first('username') }}
							</p>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has( 'password' ) ? ' has-error' : '' }}">
					<label for="password" class="control-label col-xs-12 col-sm-2">Password</label>
					<div class="col-xs-12 col-sm-10">
						{{ Form::input( 'password', 'password', null, [ 'class'=>'form-control', 'id' => 'password', 'autofocus', 'tabindex'=>2 ] ) }}
						@if( $errors->has( 'password' ) )
							<p class="help-block">
								{{ $errors->first('password') }}
							</p>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has( 'password_confirmation' ) ? ' has-error' : '' }}">
					<label for="password_confirmation" class="control-label col-xs-12 col-sm-2">Confirm Password</label>
					<div class="col-xs-12 col-sm-10">
						{{ Form::input( 'password', 'password_confirmation', null, [ 'class'=>'form-control', 'id' => 'password_confirmation', 'autofocus', 'tabindex'=>3 ] ) }}
						@if( $errors->has( 'password_confirmation' ) )
							<p class="help-block">
								{{ $errors->first('password_confirmation') }}
							</p>
						@endif
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-success" type="submit" tabindex=4>Save</button>
					</div>
				</div>

			{{ Form::close() }}
			
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h5 class="panel-title">Update User Settings</h5>
		</div>
		<div class="panel-body">
			{{ Form::model( $user, [
					'route' => [ 'admin.users.update-settings', $user->id ],
					'method' => 'PATCH',
					'class' => 'form-horizontal',
				] ) }}

			<div class="form-group{{ $errors->has( 'is_admin' ) ? ' has-error' : '' }}">
				<label for="is_admin" class="control-label col-xs-12 col-sm-2">Make Admin</label>
				<div class="col-xs-12 col-sm-10">
					<input type="checkbox" value="1" name="is_admin" data-ontext="Yes" data-offtext="No" {{ $user->is_admin ? 'checked' : '' }}/>
					@if( $errors->has( 'is_admin' ) )
						<p class="help-block">
							{{ $errors->first('is_admin') }}
						</p>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has( 'is_active' ) ? ' has-error' : '' }}">
				<label for="is_active" class="control-label col-xs-12 col-sm-2">Activate User</label>
				<div class="col-xs-12 col-sm-10">
					<input type="checkbox" value="1" name="is_active" data-ontext="Yes" data-offtext="No" {{ $user->is_active ? 'checked' : '' }}/>
					@if( $errors->has( 'is_active' ) )
						<p class="help-block">
							{{ $errors->first('is_active') }}
						</p>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button class="btn btn-success" type="submit">Save</button>
				</div>
			</div>

			{{ Form::close() }}
		</div>
	</div>
@endsection