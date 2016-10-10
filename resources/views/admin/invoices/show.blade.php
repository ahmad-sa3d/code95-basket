@extends( 'layouts.admin_master' )

@section( 'title', 'Invoice ' . $invoice->id )

@push( 'styles' )
	{{ Html::style( '/css/basket.css' ) }}
@endpush

@push( 'scripts' )
	{{ Html::script( '/js/jquery.print.min.js' ) }}
	<script>
		function printBarcode(event)
    	{
    		event.preventDefault();
    		event.stopPropagation();
    		$('.print').print();
    	}
	</script>
@endpush

@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-8">
						<h4 class="panel-title">Invoice # {{ $invoice->id }}</h4>
				</div>
				<div class="col-xs-4">
					<div class="text-right">
						<a href="#" data-toggle="tooltip" title="Print" class="no-underline font-size-p1 margin-r5 text-muted" onclick="printBarcode( event );">
		        			<span class="glyphicon glyphicon-print"></span>
		        		</a>
{{-- 						<a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="no-underline" data-toggle="tooltip" title="edit">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
						<a href="{{ route('admin.invoices.delete', $invoice->id) }}" class="no-underline margin-0-5" data-toggle="tooltip" title="delete">
							<span class="glyphicon glyphicon-trash text-danger"></span>
						</a> --}}
						<a href="{{ route('admin.invoices.index') }}" class="no-underline" data-toggle="tooltip" title="all invoices">
							<span class="fa fa-money"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			@include( 'includes.invoice' )
		</div>
	</div>
@endsection