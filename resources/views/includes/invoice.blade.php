<section class="print table-responsive">
	<div class="row">
		<div class="col-sm-6">
			<div class="data-row">
				<dt class="data-name">Invoice Id</dt>
				<dd class="data-value">{{ $invoice->id }}</dd>
			</div>

			<div class="data-row">
				<dt class="data-name">Seller</dt>
				<dd class="data-value">{{ $invoice->user->username }}</dd>
			</div>

			<div class="data-row">
				<dt class="data-name">Company</dt>
				<dd class="data-value">{{ Config::get( 'app.name' ) }}</dd>
			</div>

		</div>
		<div class="col-sm-6">
			<div class="data-row text-right">
				<dt class="data-name">Purchasing Date</dt>
				<dd class="data-value">{{ $invoice->created_at->toDayDateTimeString() }}</dd>
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
			@foreach( $invoice->sales as $sale )
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $sale->product->name }}</td>
					<td>{{ $sale->unit_price }}</td>
					<td>{{ $sale->unit_discount }}</td>
					<td>{{ $sale->quantity }}</td>
					<td>{{ $sale->total_price }}</td>
					<td>{{ $sale->total_discount }}</td>
					<td>{{ $sale->total_net_price }}</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr class="info">
				<th colspan="2">Total</th>
				<th>{{ number_format( $invoice->sales->sum('unit_price'), 2 ) }}</th>
				<th>{{ number_format( $invoice->sales->sum('unit_discount'), 2 ) }}</th>
				<th>{{ $invoice->sales->sum('quantity') }}</th>
				<th>{{ number_format( $invoice->total, 2 ) }}</th>
				<th>{{ number_format( $invoice->total_discount, 2 ) }}</th>
				<th>{{ number_format( $invoice->net, 2 ) }}</th>
			</tr>
		</tfoot>
	</table>

	<div class="footer font-verdana visible-print">
		Best Wishes, {{ Config::get( 'app.name' ) }}
	</div>
	
</section>
