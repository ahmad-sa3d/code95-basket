<?php if( isset( $session_notification ) ): ?>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
			
			<div class="alert alert-<?php echo e($session_notification['type']); ?> alert-dismissable font-naskh text-center" role="alert">
				<button type="button" class="close" aria-lable="close" data-dismiss="alert">
					<span aria-hidden=true>&times;</span>
				</button>
				<?php echo $session_notification['message']; ?>

				<?php if( isset( $session_notification['link'] ) ): ?>
					<a href="<?php echo e($session_notification['link']); ?>" class="pull-right">
						<strong><span Class="glyphicon glyphicon-link"></span></strong>
					</a>
				<?php endif; ?>
			</div>

		</div>
	</div>
<?php endif; ?>