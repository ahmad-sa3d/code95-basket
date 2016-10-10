$( '#captcha-refresh' ).on( 'click', function(e){

	e.preventDefault();
	e.stopPropagation();
	
	$.ajax( {

		type: 'post',
		url: urlToRoute( 'captcha.renew' ),
		data: { blocks: 1, min: 5, max: 5, _token: csrfToken },
		beforeSend: function(){
			// Start Spining
			$(e.target).addClass( 'spin' );
		}

	} )
	.done( function( response, xhr, status ){
		// Update Image Src
		var img = document.getElementById( 'captcha-image' );
		
		// append Time to src url to be unique and avoid caching
		// so making sure that we alwayes refresh image
		img.src = urlToRoute( 'captcha' )+'?time=' + new Date().getTime();
	} )
	.fail( function( status, xhr, error ){

		console.log( status );
	} )
	.always( function( xhr ){
		
		// Stop Spinning
		$(e.target).removeClass( 'spin' );
	} );

} );