<?php $__env->startSection( 'title', 'Create User' ); ?>

<?php $__env->startPush( 'styles' ); ?>
	<?php echo e(Html::style( '/css/rcswitcher.min.css' )); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush( 'scripts' ); ?>
	<?php echo e(Html::script( '/js/rcswitcher.min.js' )); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
					<h4 class="panel-title">Create New User</h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="<?php echo e(route('admin.users.index')); ?>" class="no-underline" data-toggle="tooltip" title="all users">
							<span class="fa fa-group"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<?php echo e(Form::open( [
					'route' => [ 'admin.users.store' ],
					'method' => 'POST',
					'class' => 'form-horizontal',
				] )); ?>

				
				<div class="form-group<?php echo e($errors->has( 'username' ) ? ' has-error' : ''); ?>">
					<label for="username" class="control-label col-xs-12 col-sm-2">User Name</label>
					<div class="col-xs-12 col-sm-10">
						<?php echo e(Form::text( 'username', old('username'), [ 'class'=>'form-control', 'id' => 'username', 'required', 'autofocus', 'tabindex'=>1 ] )); ?>

						<?php if( $errors->has( 'username' ) ): ?>
							<p class="help-block">
								<?php echo e($errors->first('username')); ?>

							</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has( 'password' ) ? ' has-error' : ''); ?>">
					<label for="password" class="control-label col-xs-12 col-sm-2">Password</label>
					<div class="col-xs-12 col-sm-10">
						<?php echo e(Form::input( 'password', 'password', null, [ 'class'=>'form-control', 'id' => 'password', 'tabindex'=>2, 'required' ] )); ?>

						<?php if( $errors->has( 'password' ) ): ?>
							<p class="help-block">
								<?php echo e($errors->first('password')); ?>

							</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has( 'password_confirmation' ) ? ' has-error' : ''); ?>">
					<label for="password_confirmation" class="control-label col-xs-12 col-sm-2">Confirm Password</label>
					<div class="col-xs-12 col-sm-10">
						<?php echo e(Form::input( 'password', 'password_confirmation', null, [ 'class'=>'form-control', 'id' => 'password_confirmation', 'tabindex'=>3, 'required' ] )); ?>

						<?php if( $errors->has( 'password_confirmation' ) ): ?>
							<p class="help-block">
								<?php echo e($errors->first('password_confirmation')); ?>

							</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has( 'is_admin' ) ? ' has-error' : ''); ?>">
					<label for="is_admin" class="control-label col-xs-12 col-sm-2">Make Admin</label>
					<div class="col-xs-12 col-sm-10">
						<input type="checkbox" value="1" name="is_admin" data-ontext="Yes" data-offtext="No" <?php echo e(old('is_admin') ? 'checked' : ''); ?> tabindex=4/>
						<?php if( $errors->has( 'is_admin' ) ): ?>
							<p class="help-block">
								<?php echo e($errors->first('is_admin')); ?>

							</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has( 'is_active' ) ? ' has-error' : ''); ?>">
					<label for="is_active" class="control-label col-xs-12 col-sm-2">Activate User</label>
					<div class="col-xs-12 col-sm-10">
						<input type="checkbox" value="1" name="is_active" data-ontext="Yes" data-offtext="No" <?php echo e(old('is_active') ? 'checked' : ''); ?> tabindex=5/>
						<?php if( $errors->has( 'is_active' ) ): ?>
							<p class="help-block">
								<?php echo e($errors->first('is_active')); ?>

							</p>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-success" type="submit" tabindex=6>Save</button>
					</div>
				</div>

			<?php echo e(Form::close()); ?>

			
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>