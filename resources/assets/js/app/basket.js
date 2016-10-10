/*-----------------------------------------------------------------------------------------*\
|										 ORDERS 											|
\*-----------------------------------------------------------------------------------------*/

// Prevent Dropdown closing
var $basket = $('.basket-panel'),
	$confirmOrder = $basket.find( '.confirm-order' ),
	$deleteOrder = $basket.find( '.delete-order' ),
	$refreshOrder = $basket.find( '.refresh-order' ),
	$clearOrder = $basket.find( '.clear-order' ),
	// Top Nave Count
	$basketCount = $( '.basket .count' ),
	$order = $basket.find('.order'),
	$items = $order.find( 'tr[data-id]' ),
	$total = $order.find( 'tr.total' ),
	$newOrder = $basket.find('.new-order'),
	$ajaxLoader = $basket.find( '.ajax-loader' ),
	$add = $('.add-to-basket');

	
// Stop Bootstrap Dropdown Menu From Closing 
$basket.click( function(e)
{
	e.stopPropagation();
});

// Add Order Item
$add.click( function(e){
	e.preventDefault();
	e.stopPropagation();

	if( $order.length == 0 )
	{
		console.log( 'No Opened Orders' );
		return;
	}
	
	if( Number.parseInt( this.dataset.instock ) )
	{
		orderItems[ this.dataset.id ] = 1;

		updateOrder();

		$(this).addClass('disabled').text('In Basket');
	}
	else
		$(this).addClass('disabled btn-danger');
} );


/*------------------------------------------| Listeners |----------------------------------------*/

function attachBehaviour()
{
	attachRefreshOrder();
	attachClearOrder();
	attachConfirmOrder();
	attachDeleteOrder();
	attachDeleteOrderItem();
	attachQuantityChange();
	attachNewOrder();
}

function removeBehaviour()
{
	detachRefreshOrder();
	detachClearOrder();
	detachDeleteOrder();
	detachConfirmOrder();
	detachDeleteOrderItem();
	detachQuantityChange();
	detachNewOrder();
}

function attachRefreshOrder()
{
	$refreshOrder.click( function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		if( $items.length )
			updateOrder();
	} );
}

function detachRefreshOrder()
{
	$refreshOrder.off( 'click' );
}

function attachConfirmOrder()
{
	$confirmOrder.click( function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		if( $items.length )
		{
			updateOrder( function( response ){

				confirmOrder( function( invoice_id ){
					window.location.href = urlToRoute( 'invoice', invoice_id );
				} );
			} );
		}
	} );
}

function detachConfirmOrder()
{
	$confirmOrder.off( 'click' );
}

function attachClearOrder()
{
	$clearOrder.click( function(e)
	{
		e.preventDefault();
		e.stopPropagation();
		if( $items.length )
		{
			orderItems = {};
			updateOrder();
		}
		
	} );
}

function detachClearOrder()
{
	$clearOrder.off( 'click' );
}

function attachDeleteOrder()
{
	$deleteOrder.click( function(e)
	{
		e.preventDefault();
		e.stopPropagation();
		
		$.ajax( {
			url: urlToRoute( 'order.destroy', $order[0].dataset.id ),
			type: 'POST',
			data: { _token: csrfToken, _method: 'DELETE' },
			dataType: 'JSON',
			beforeSend: function(){
				$ajaxLoader.fadeIn();
			}
		} )
		.always( function(){
			$ajaxLoader.fadeOut();
		} )
		.done(function( response, xhr, status ){
			if( response.status == 'success' )
			{
				// $basket.find( '.panel-footer' ).remove().end()
				// 	.find( '.order-data' ).remove().end()
				// 	.find( '.panel-heading' ).after( '<div class="panel-body">No Orders! Open Order\
				// 		<a href="#" class="no-underline new-order">\
				// 			<i class="fa fa-shopping-basket"></i>\
				// 		</a></div>'
				// 	);

				// $newOrder = $basket.find('.new-order');

				// removeBehaviour();
				// attachNewOrder();
				window.location.href = window.location.origin + window.location.pathname;

			}else{
				console.log( response.message )
			}
		});
	} );
}

function detachDeleteOrder()
{
	$deleteOrder.off('click');
}

function attachDeleteOrderItem()
{
	// Delete Order Item
	$order.on( 'click', '.delete-item', function(e){
		e.preventDefault();
		e.stopPropagation();

		var id = e.target.parentNode.dataset.id;
		delete orderItems[ id ];

		updateOrder();
		
	} );
}

function detachDeleteOrderItem()
{
	// Create New Order On Server
	$order.off('.delete-item');
}

function attachNewOrder()
{
	// Create New Order On Server
	$newOrder.click( function(e){
		e.preventDefault();
		e.stopPropagation();

		$.ajax( {
			url: urlToRoute( 'order.open' ),
			type: 'POST',
			data: { _token: csrfToken },
			dataType: 'JSON',
			beforeSend: function(){
				$ajaxLoader.fadeIn();
			}
		} )
		.always( function()
		{
			$ajaxLoader.fadeOut();
		} )
		.done(function( response, xhr, status )
		{
			if( response.status == 'success' )
			{
				buildOrder( response.order );
			}
			else
			{
				$basket.find('.panel-body').html( response.message );
			}

		});
	} );
}

function detachNewOrder()
{
	// Create New Order On Server
	$newOrder.off('click');
}

// Listen For Quantity Change
function attachQuantityChange()
{
	// Change Item Quantity
	$order.on( 'change', 'select', function(e){
		e.preventDefault();
		e.stopPropagation();
		
		orderItems[ e.currentTarget.dataset.id ] = e.currentTarget.value;

		updateOrder();
		
	} );
}

// Stop Listening For Quantity Change
function detachQuantityChange()
{
	// Change Item Quantity
	$order.off( 'change', 'select' );
}

/*------------------------------------------| End Of Listeners |----------------------------------*/

function buildOrder( order )
{
	var orderBody = '<div class="order-data">\
					<table class="order table table-bord-ered table-condensed table-hover" data-id="'+order.id+'">\
						<thead>\
							<tr>\
								<th class="text-center">#</th>\
								<th class="text-center">name</th>\
								<th class="text-center">quantity</th>\
								<th class="text-center">net price <span class="label label-info">L.E.</span></th>\
								<th class="text-center">remove</th>\
							</tr>\
						</thead>\
						<tbody>\
							\
						</tbody>\
						<tfoot>\
							<tr class="active total success">\
								<th class="text-center" colspan=2>Total</th>\
								<th class="text-center quantity">0</th>\
								<th class="text-center net-price">0</th>\
								<th class="text-center"></th>\
							</tr>\
						</tfoot>\
					</table>\
				</div>';
	
	var footer = '<div class="panel-footer">\
					<div class="row">\
						<div class="col-xs-3">\
							<a href="#" class="btn btn-danger btn-xs btn-block delete-order">Delete</a>\
						</div>\
						<div class="col-xs-3">\
							<a href="#" class="btn btn-warning btn-xs btn-block clear-order">clear</a>\
						</div>\
						<div class="col-xs-3">\
							<a href="#" class="btn btn-success btn-xs btn-block confirm-order">Confirm</a>\
						</div>\
						<div class="col-xs-3">\
							<a href="#" class="btn btn-primary btn-xs btn-block refresh-order">Refresh</a>\
						</div>\
					</div>\
				 </div>';

	$basket.append( footer ).find( '.panel-heading' ).after( orderBody ).end().find('.panel-body').remove();

	$order = $basket.find('.order'),
	$items = $order.find( 'tr[data-id]' ),
	$total = $order.find( 'tr.total' ),
	orderItems = {},
	$confirmOrder = $basket.find( '.confirm-order' ),
	$deleteOrder = $basket.find( '.delete-order' ),
	$refreshOrder = $basket.find( '.refresh-order' ),
	$clearOrder = $basket.find( '.clear-order' );

	// Attach Listeners
	attachBehaviour();
}

// Update Order
function updateOrder( callback )
{
	// console.log(orderItems);

	$.ajax( {
		url: urlToRoute( 'order.update' ),
		type: 'POST',
		data: { _token: csrfToken, _method: 'PUT', items: orderItems },
		dataType: 'JSON',
		beforeSend: function(){
			$ajaxLoader.fadeIn();
		}
	} )
	.always( function(){
		$ajaxLoader.fadeOut();
	} )
	.done(function( response, xhr, status ){
		if( response.status == 'success' )
		{
			orderItems = response.data;

			sync( response, callback );
			
		}else{
			console.log( response.message )
		}
	});
};

function confirmOrder( callback ) {
	$.ajax( {
		url: urlToRoute( 'order.confirm' ),
		type: 'POST',
		data: { _token: csrfToken },
		dataType: 'JSON',
		beforeSend: function(){
			$ajaxLoader.fadeIn();
		}
	} )
	.always( function(){
		$ajaxLoader.fadeOut();
	} )
	.done(function( response, xhr, status ){
		if( response.status == 'success' )
		{
			if( typeof callback == 'function' )
				callback.call( this, response.invoice_id );
			
		}else{
			console.log( response.message )
		}
	});		}

// Sync Order With Server
function sync( response, callback )
{
	// Here orderItems Are Synced From Server, so ===>      orderItems[ id ] <==> response.items[id].quantity
	var needRefresh = false;
	
	// Stop Listening To Quantity Change, to avoid instock that are less than quantity problem
	detachQuantityChange();

	// Remove Deleted
	response.deleted.forEach( function( id ){
		
		$('.add-to-basket[data-id='+id+']').removeClass('disabled').html('Add To Basket <i class="fa fa-shopping-cart font-size-p2"></i>');

		// Get Row
		var $row = $order.find( 'tr[data-id='+id+']' );
		
		// Remove From Collection
		$items = $items.not( $row );
		
		// Remove From Basket
		$row.slideUp( function(){ $(this).remove() } );
	} );

	// Update Existed
	$items.each( function( i, row )
	{
		id = row.dataset.id;
		$row = $(row);

		// Update Name
		$row.find('.iteration').html( i+1 );
		$row.find('.name').html( response.items[ id ].name );
		
		var $quantitySelect = $row.find('select'),
			optionsCount = Object.keys( $quantitySelect[0].selectize.options ).length;
		
		// Check Instock Quantity
		if( optionsCount != response.items[ id ].instock_quantity )
		{
			if( optionsCount >= response.items[ id ].instock_quantity )
			{
				// Remove Out Options
				for( i = response.items[ id ].instock_quantity+1; i<= optionsCount; i++ )
					$quantitySelect[0].selectize.removeOption(i);

			}
			else
			{
				// Add Options
				for( i = optionsCount+1; i<= response.items[ id ].instock_quantity; i++ )
					$quantitySelect[0].selectize.addOption({ value: i, text: i });
			}
				
		}

		// Update Quantity
		// console.log( orderItems[ id ] );
		// $quantitySelect.val( orderItems[ id ] );
		if( orderItems[ id ] == 0 )
		{
			$quantitySelect[0].selectize.addOption({ value: 0, text: 0 });

			needRefresh = true;
		}

		$quantitySelect[0].selectize.setValue( orderItems[ id ], true );

		// Update Price
		$row.find('.net-price').html( response.items[ id ].net_price );
	} );

	// Add New Items
	response.added.forEach( function( id ){
		
		var $select = $('<select>', { 'name': 'quantity', 'class': 'form-control', 'data-id': id });
		
		if( orderItems[ id ] != 0 )
		{
			for( i=1; i<=response.items[ id ].instock_quantity; i++ )
				$select.append( '<option value="'+i+'">'+i+'</option>' );
		}
		else
		{
			$select.append( '<option value="0">0</option>' );

			needRefresh = true;
		}
		

		$select.val( orderItems[ id ] );

		var $quantityCell = $('<td>', {'class': 'quantity'}).append( $select );

		var $newRow = $( '<tr>', { 'class': 'text-center', 'data-id': id } ).append(
			'<td class="iteration">' + ($items.length+1) + '</td>',
			'<td class="name">' + response.items[id].name + '</td>',
			$quantityCell,
			'<td class="net-price">'+ response.items[id].net_price +'</td>',
			'<td><a class="text-danger delete-item" href="#" data-id="'+ id +'"><i class="glyphicon glyphicon-trash"></i></a></td>'
			);

		$select.selectize();

		$items = $items.add( $newRow );

		$order.find('tbody').append( $newRow );
		
	} );

	// Update Totals
	$total.find( '.quantity' ).html( response.total.quantity );
	$total.find( '.net-price' ).html( response.total.net_price );

	// Update Top Nave Count
	if( Number.parseInt( $basketCount.text() ) != response.total.quantity )
	{
		$basketCount.addClass( 'ping' );
		$basketCount.html( response.total.quantity );
		setTimeout( function(){ $basketCount.removeClass( 'ping' ); }, 1000 );
	}

	if( needRefresh )
		updateOrder( callback );
	else
	{
		if( typeof callback == 'function' )
			callback.call( this, response );
	}

	// Re Listen To Quantity Change
	attachQuantityChange();
	
}

// Listeners
attachBehaviour();