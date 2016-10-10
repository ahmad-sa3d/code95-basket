<section class="print table-responsive">
	<div class="row">
		<div class="col-sm-6">
			<div class="data-row">
				<dt class="data-name">Invoice Id</dt>
				<dd class="data-value"><?php echo e($invoice->id); ?></dd>
			</div>

			<div class="data-row">
				<dt class="data-name">Seller</dt>
				<dd class="data-value"><?php echo e($invoice->user->username); ?></dd>
			</div>

			<div class="data-row">
				<dt class="data-name">Company</dt>
				<dd class="data-value"><?php echo e(Config::get( 'app.name' )); ?></dd>
			</div>

		</div>
		<div class="col-sm-6">
			<div class="data-row text-right">
				<dt class="data-name">Purchasing Date</dt>
				<dd class="data-value"><?php echo e($invoice->created_at->toDayDateTimeString()); ?></dd>
			</div>
		</div>
	</div>
	<table class="table invoice table-hover table-bordered">
		
		<thead>
			<tr>
				<th>#</th>
				<th>Product</th>
				<th>Price <span class="label label-info">L.E.</span></th>
				<th>Discount <span class="label label-info">L.E.</span></th>
				<th>Quantity</th>
				<th>Total Price <span class="label label-info">L.E.</span></th>
				<th>Total Discount <span class="label label-info">L.E.</span></th>
				<th>Net Price <span class="label label-info">L.E.</span></th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $invoice->sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<tr>
					<td><?php echo e($loop->iteration); ?></td>
					<td><?php echo e($sale->product->name); ?></td>
					<td><?php echo e($sale->unit_price); ?></td>
					<td><?php echo e($sale->unit_discount); ?></td>
					<td><?php echo e($sale->quantity); ?></td>
					<td><?php echo e($sale->total_price); ?></td>
					<td><?php echo e($sale->total_discount); ?></td>
					<td><?php echo e($sale->total_net_price); ?></td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		</tbody>
		<tfoot>
			<tr class="info">
				<th colspan="2">Total</th>
				<th><?php echo e(number_format( $invoice->sales->sum('unit_price'), 2 )); ?></th>
				<th><?php echo e(number_format( $invoice->sales->sum('unit_discount'), 2 )); ?></th>
				<th><?php echo e($invoice->sales->sum('quantity')); ?></th>
				<th><?php echo e(number_format( $invoice->total, 2 )); ?></th>
				<th><?php echo e(number_format( $invoice->total_discount, 2 )); ?></th>
				<th><?php echo e(number_format( $invoice->net, 2 )); ?></th>
			</tr>
		</tfoot>
	</table>

	<div class="footer font-verdana visible-print">
		Best Wishes, <?php echo e(Config::get( 'app.name' )); ?>

	</div>
	
</section>
