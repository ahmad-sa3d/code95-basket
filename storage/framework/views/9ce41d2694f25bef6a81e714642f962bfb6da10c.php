<?php $__env->startSection( 'title', 'System Invoices' ); ?>

<?php $__env->startSection( 'content' ); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">Invoices</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-8">
					<h5>All Invoices <span class="badge green-bg"><?php echo e($invoices->total()); ?></span></h5>
				</div>
				<div class="col-xs-4">

				</div>
			</div>
			
		</div>
		<?php if( !$invoices->isEmpty() ): ?>
			<div class="table-responsive">
				<table class="table table-bordered text-center">
					<thead>
						<tr>
							<th class="col-xs-1 text-center">#</th>
							<th class="text-center">Seller</th>
							<th class="text-center">ID</th>
							<th class="text-center">Total <span class="label label-primary">L.E.</span></th>
							<th class="text-center">Total Net <span class="label label-primary">L.E.</span></th>
							<th class="text-center">Date</th>
							<th class="text-center">Show</th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<tr>
								<td><?php echo e($loop->iteration); ?></td>
								<td><?php echo e($invoice->user->username); ?></td>
								<td><?php echo e($invoice->id); ?></td>
								<td><?php echo e(number_format( $invoice->total, 2 )); ?></td>
								<td><?php echo e(number_format( $invoice->net, 2 )); ?></td>
								<td><?php echo e($invoice->created_at->diffForHumans()); ?></td>
								<td>
									<a href="<?php echo e(route('admin.invoices.show', $invoice->id)); ?>" data-toggle="tooltip" title="Show <?php echo e($invoice->username); ?>" class="no-underline">
										<span class="fa fa-money"></span>
									</a>
									
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</tbody>
					<?php if( $invoices->hasPages() ): ?>
						<tfoot>
							<tr>
								<td colspan="7" class="text-left">
									<?php echo e($invoices->links()); ?>

								</td>
							</tr>
						</tfoot>
					<?php endif; ?>
				</table>
			</div>
		<?php endif; ?>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>