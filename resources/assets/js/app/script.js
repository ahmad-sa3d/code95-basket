
/*---------------------------------------------------------------------------
*								On Ready
*---------------------------------------------------------------------------*/


/************************
/*	MAIN NAVIGATION
/************************/

$currentActive = $( '.sidebar .current' );

$activeUl = $currentActive.parent('.sub-menu');
if( $activeUl.length > 0 )
{
	$activeUl.addClass('open');

	$activeUl.parent('li').addClass('active').find(' > a > .toggle-icon').removeClass('fa-angle-left').addClass('fa-angle-down');

}

// Open Initial Opened Sub Menu
var $opened = $('.sidebar .sub-menu.open')
		.css('display', 'block')
		.css('overflow', 'visible');

// Check to Open Parents in cases of sub opened and parents closed
var $parent_sub = $opened.parentsUntil('.main-menu', 'ul.sub-menu');
if( $parent_sub.length > 0 )
{
	if( !$parent_sub.hasClass('open') )
	{
		$parent_sub.addClass('open').css('display', 'block').css('overflow', 'visible');
		$parent_sub.parentsUntil('.main-menu', 'li').addClass('active')
			.find( 'a .toggle-icon' ).removeClass('fa-angle-left').addClass('fa-angle-down');
		
	}
}

// Toggle SubMenu
$('.main-menu .js-sub-menu-toggle').on('click', function(e){

	e.preventDefault();

	$li = $(this).parent('li');
	if( !$li.hasClass('active')){
		$li.find(' > a .toggle-icon').removeClass('fa-angle-left').addClass('fa-angle-down');
		$li.addClass('active');
		$li.find(' > ul.sub-menu')
			.slideDown(300)
			.addClass('open');
	}
	else {
		$li.find(' a .toggle-icon').removeClass('fa-angle-down').addClass('fa-angle-left');
		$li.removeClass('active').find('li').removeClass('active');
		$li.find('ul.sub-menu.open')
			.slideUp(300)
			.removeClass('open');
	}
});


// Collapse sidebar Button
$('.toggle-sidebar-collapse').on('click', function(e) {
	
	e.preventDefault();
	
	if( $(window).width() < 992) {
		// use float sidebar
		if(!$('.sidebar').hasClass('sidebar-float-active')) {
			$('.sidebar').addClass('sidebar-float-active');
		} else {
			$('.sidebar').removeClass('sidebar-float-active');
		}
	} else {
		// use collapsed sidebar
		if(!$('.sidebar').hasClass('sidebar-hide')) {
			$('.sidebar').addClass('sidebar-hide');
			$('.content-wrapper.with-sidebar').addClass('expanded-full');
		} else {
			$('.sidebar').removeClass('sidebar-hide');
			$('.content-wrapper.with-sidebar').removeClass('expanded-full');
		}
	}
});

// determine sidebar status on window resize and load
$(window).bind( 'load resize', determineSidebar);

function determineSidebar() {

	if( $(window).width() < 992) {
		$('body').addClass('sidebar-float');

	}else {
		$('body').removeClass('sidebar-float');
	}
}


// slimscroll left navigation
var wheelStep = myUtil.isMobile() ? 55 : 5; // For Mobile and touch devices it is needed to be 55

if( $('body.sidebar-fixed').length > 0 ) {
	$('body.sidebar-fixed .sidebar-scroll').slimScroll({
		height: '100%',
		wheelStep: wheelStep,
	});
}

// Bootstrap Popover & Tooltip
$('a[data-toggle="popover"]').popover({ 'placement': 'top', trigger: 'hover' });
$('[data-toggle="tooltip"]').tooltip({ 'placement': 'top', container: 'body' })


// Fade Page
setTimeout( function(){ $( '.content-wrapper.with-sidebar' ).css( { visibility: 'visible', opacity: 1 } ) }, 350 );


if( typeof $.fn.rcSwitcher == 'function' )
{
	// RCSWITCHER
	$('[type=checkbox]').rcSwitcher({
		blobOffset: 2,
		theme: 'flat'
	});
}

// Use Default Image For Any Broken Image 'default must be exists at the same folder'
$('img').on( 'error', function(){
	src = this.src;
	src = src.replace( /([\w\d-_]+(\.\w{3,4}))$/g, 'default.png' );
	this.src = src;
	$(this).off( 'error' );
} );

// Clear Notifications
$clear = $( '#clear-notifications' ),
$notificationsWraper = $( '.notifications-wraper' ),
$notificationsAjaxLoader = $notificationsWraper.find('.ajax-loader');
$notificationsCount = $('.notifications .count');

$noNewNotifications = $('<li>', {'class': 'no-notifications'})
					.append( '<span>\
                        <span class="text">No New Notifications</span>\
                    </span>' );

$clear.click( function(e){
	e.stopPropagation();
	e.preventDefault();
	$.ajax( {
		type: 'POST',
		url: urlToRoute( 'admin.dashboard.clear-notifications' ),
		data: { _token: csrfToken },
		dataType: 'JSON',
		beforeSend: function(){
			$notificationsAjaxLoader.fadeIn();
		}
	} ).done(function(result){
		
		$('.notifications .notification-footer').slideUp();
		$notificationsWraper.find( 'li' ).slideUp( function(){
			$notificationsWraper.append( $noNewNotifications );
		} );

		$notificationsCount.html('').fadeOut();
		
	}).always( function(){
		$notificationsAjaxLoader.fadeOut();
	} );

} );
