<div class="panel panel-default basket-panel">
	<div class="panel-heading">
		<h6 class="panel-title font-size-m1">Current Basket</h6>
	</div>
	{{-- <div class="panel-body"> --}}
		@if( !$order )
			<div class="panel-body">
				@if( Auth::user()->is_active )
					No Orders! Open Order
					<a href="#" class="no-underline new-order">
						<i class="fa fa-shopping-basket"></i>
					</a>
				@else
					Sorry, You Cannot Make Orders.
				@endif
			</div>
		@else
			<div class="order-data">
				{{-- @if( $order->data ) --}}
					<table class="order table table-bord-ered table-condensed table-hover" data-id="{{ $order->id }}">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">name</th>
								<th class="text-center">quantity</th>
								<th class="text-center">net price</span></th>
								<th class="text-center">remove</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $order->items as $item )
								<tr data-id="{{ $item['id'] }}" class="text-center">
									<td class="iteration valign-middle">{{ $loop->iteration }}</td>
									<td class="name valign-middle">{{ $item['name'] }}</td>
									<td class="quantity valign-middle">
										{{ Form::select( 'quantity', range(0,$item['instock_quantity'] ), $item['quantity'], ['class'=>'form-control', 'data-id'=> $item['id'] ] ) }}
									</td>
									<td class="net-price valign-middle">{{ number_format( $item['net_price'], 2 ) }}</td>
									<td class="valign-middle"><a class="text-danger delete-item" href="#" data-id="{{ $item['id'] }}" data-toggle="tooltip" title="Remove Item"><i class="glyphicon glyphicon-trash"></i></a></td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr class="active total success">
								<th class="text-center" colspan=2>Total</th>
								<th class="text-center quantity">{{ $order->items->sum('quantity') }}</th>
								<th class="text-center net-price">{{ number_format( $order->items->sum('net_price'), 2 ) }}</th>
								<th class="text-center"></th>
							</tr>
						</tfoot>
					</table>
				{{-- @else
					Empty Basket
				@endif --}}
			</div>
		@endif
	{{-- </div> --}}

	@if( $order )
		<div class="panel-footer">
			<div class="row">
				<div class="col-xs-3">
					<a href="#" class="btn btn-danger btn-xs btn-block delete-order">Delete</a>
				</div>
				<div class="col-xs-3">
					<a href="#" class="btn btn-warning btn-xs btn-block clear-order">clear</a>
				</div>
				<div class="col-xs-3">
					<a href="#" class="btn btn-success btn-xs btn-block confirm-order">Confirm</a>
				</div>

				<div class="col-xs-3">
					<a href="#" class="btn btn-primary btn-xs btn-block refresh-order">Refresh</a>
				</div>
			</div>
		</div>
	@endif
	<div class="ajax-loader"></div>
</div>
	
