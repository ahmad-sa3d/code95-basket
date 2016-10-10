@extends( 'layouts.admin_master' )

@section( 'title', 'Create User' )

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
					<h4 class="panel-title">Create New User</h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="{{ route('admin.users.index') }}" class="no-underline" data-toggle="tooltip" title="all users">
							<span class="fa fa-group"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			{{ Form::open( [
					'route' => [ 'admin.users.store' ],
					'method' => 'POST',
					'class' => 'form-horizontal',
				] ) }}
				
				<div class="form-group{{ $errors->has( 'username' ) ? ' has-error' : '' }}">
					<label for="username" class="control-label col-xs-12 col-sm-2">User Name</label>
					<div class="col-xs-12 col-sm-10">
						{{ Form::text( 'username', old('username'), [ 'class'=>'form-control', 'id' => 'username', 'required', 'autofocus', 'tabindex'=>1 ] ) }}
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
						{{ Form::input( 'password', 'password', null, [ 'class'=>'form-control', 'id' => 'password', 'tabindex'=>2, 'required' ] ) }}
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
						{{ Form::input( 'password', 'password_confirmation', null, [ 'class'=>'form-control', 'id' => 'password_confirmation', 'tabindex'=>3, 'required' ] ) }}
						@if( $errors->has( 'password_confirmation' ) )
							<p class="help-block">
								{{ $errors->first('password_confirmation') }}
							</p>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has( 'is_admin' ) ? ' has-error' : '' }}">
					<label for="is_admin" class="control-label col-xs-12 col-sm-2">Make Admin</label>
					<div class="col-xs-12 col-sm-10">
						<input type="checkbox" value="1" name="is_admin" data-ontext="Yes" data-offtext="No" {{ old('is_admin') ? 'checked' : '' }} tabindex=4/>
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
						<input type="checkbox" value="1" name="is_active" data-ontext="Yes" data-offtext="No" {{ old('is_active') ? 'checked' : '' }} tabindex=5/>
						@if( $errors->has( 'is_active' ) )
							<p class="help-block">
								{{ $errors->first('is_active') }}
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