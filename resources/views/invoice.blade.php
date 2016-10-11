@extends('layouts.master')

@section( 'title', 'Invoice #' . $invoice->id )

@push( 'styles' )
	{{ Html::style( '/css/selectize.min.css' ) }}
@endpush
@push( 'scripts' )
	{{ Html::script( '/js/selectize.min.js' ) }}
	<script>
		function printBarcode(event)
    	{
    		event.preventDefault();
    		event.stopPropagation();
    		$('.print').print();
    	}

		// Very Important For /js/basket.min.js to work
		orderItems = JSON.parse( '{!! ( $order ) ? json_encode( $order->items->map( function($item){ return $item["quantity"]; } ), JSON_FORCE_OBJECT ) : "{}" !!}' );
	</script>
	{{ Html::script( '/js/basket.min.js' ) }}
	{{ Html::script( '/js/jquery.print.min.js' ) }}
@endpush

@section( 'content' )
	<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
        	<div class="col-xs-9">
        		<h4 class="panel-title">Invoice # {{ $invoice->id }}</h4>
        	</div>
        	<div class="col-xs-3 text-right">
        		<a href="#" data-toggle="tooltip" title="Print" class="no-underline font-size-p1 margin-r5 text-muted" onclick="printBarcode( event );">
        			<span class="glyphicon glyphicon-print"></span>
        		</a>
        		<a href="{{ route( 'home' ) }}" data-toggle="tooltip" title="Print" class="no-underline font-size-p1 text-muted">
        			<span class="glyphicon glyphicon-home"></span>
        		</a>
        	</div>
        </div>
        
    </div>

    <div class="panel-body">
		@include( 'includes.invoice' )
	</div>
</div>
@endsection