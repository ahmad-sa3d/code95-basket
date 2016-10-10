@extends( 'layouts.admin_master' )

@section( 'title', 'System Invoices' )

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">Invoices</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-8">
					<h5>All Invoices <span class="badge green-bg">{{ $invoices->total() }}</span></h5>
				</div>
				<div class="col-xs-4">

				</div>
			</div>
			
		</div>
		@if( !$invoices->isEmpty() )
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
						@foreach( $invoices as $invoice )
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $invoice->user->username }}</td>
								<td>{{ $invoice->id }}</td>
								<td>{{ number_format( $invoice->total, 2 ) }}</td>
								<td>{{ number_format( $invoice->net, 2 ) }}</td>
								<td>{{ $invoice->created_at->diffForHumans() }}</td>
								<td>
									<a href="{{ route('admin.invoices.show', $invoice->id) }}" data-toggle="tooltip" title="Show {{ $invoice->username }}" class="no-underline">
										<span class="fa fa-money"></span>
									</a>
									{{-- <a href="{{ route('admin.invoices.edit', $invoice->id) }}" data-toggle="tooltip" title="Edit {{ $invoice->username }}" class="margin-0-5 no-underline">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a href="{{ route('admin.invoices.delete', $invoice->id) }}" data-toggle="tooltip" title="Delete {{ $invoice->username }}" class="no-underline">
										<span class="glyphicon glyphicon-trash text-danger"></span>
									</a> --}}
								</td>
							</tr>
						@endforeach
					</tbody>
					@if( $invoices->hasPages() )
						<tfoot>
							<tr>
								<td colspan="7" class="text-left">
									{{ $invoices->links() }}
								</td>
							</tr>
						</tfoot>
					@endif
				</table>
			</div>
		@endif
	</div>
@endsection