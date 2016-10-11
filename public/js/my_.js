/**
 * Js MymyUtil is some helpers tools that might bee needed for every Project
 *
 * @package 	myUtil
 * @name  		myUtil
 * @author  	Ahmed Saad <a7mad.sa3d.2014@gmail.com><ahmedfadlshaker@gmail.com>
 * @copyright 	ahmed Saad < Jul 2016 >
 * @version  	2.5 < 19 Aug 2016 >
 * @license  	<https://creativecommons.org/licenses/by-nc-sa/4.0/legalcode> CC BY-NC-SA 	Licence
 */

var myUtil = (function(myUtil)
{
	// myUtil Object
	myUtil.documentElement = document.documentElement || document.body.parentNode || document.body;

	myUtil.isStandardMode = (document.compatMode == "BackCompat") ? false : true;
	
	var scrollBarWidth, scrollBarHalfWidth, pageOffsets, browserInfo, systemInfo, mobile = null;

	/**
	 * Check If Is Mobile
	 * 
	 * @return {Bool} Mobile
	 */
	myUtil.isMobile = function(){
	
		if( mobile !== null )
			return mobile;

		return mobile = ( navigator.userAgent.indexOf( 'Mobile' ) !== -1 || navigator.userAgent.indexOf( 'Android' ) !== -1 ) ? true : false;
		
	}

	/**
	 * Get Browser Information
	 * 
	 * @return {Object} Browser Information
	 */
	myUtil.getBrowserInfo = function(){


		if( typeof browserInfo !== 'undefined' ) return browserInfo;

		// 1- detect browser
		
		//								      				 1/ver 		  2/sys 	if Version/ exists			 3/ver       |OR| 4/sys 					 5/ver
		if( opera = navigator.userAgent.match( /(?:Opera\/([0-9\.\w]+)\s\((.+?)\)(?:(?=.*Version\/).*Version\/([0-9\.\w]+)|.*))|\((.+?)\).+?Opera(?:[\s\/]([0-9\.\w]+))?/ ) )
		{
			// Opera
			// str = 'Opera/9.70 (Linux ppc64 ; U; en) Presto/2.2.1 Version/2.2';
			// str = 'Opera/9.70 (Linux ppc64 ; U; en) Presto/2.2.1';
			// str = 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0) Opera/34';
			// str = 'Mozilla/5.0 (Windows NT 6.1; U; de; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6 Opera 11.01';
			// str = 'HTC_HD2_T8585 Opera/9.70 (Windows NT 5.1; U; de)';
			// str = 'Opera/9.63 (X11; Linux i686; U; ru)';
			// str = 'Opera/9.80 (Linux i686; Opera Mobi/1038; U; en) Presto/2.5.24 Version/10.00';

			browserInfo = {
				name : 'Opera',
				version : opera[5]||opera[3]||opera[1]||'',
				cssVendor : 'o',
				sysStr: opera[4]||opera[2],
			}

		}//									  1/ver 						2/sys 		   |OR| 3/sys				  	 4/ver											  		1/sys 				  	2/ver
		else if( ie = navigator.userAgent.match( /(?:MSIE\s+([0-9\.\w]+)(?:(?=.+Win).+?(Win.+[0-9\.\w]+)|.*))|\((.+?);.+?Trident.*?rv:([0-9\.\w]+)/i ) )
		{
			// IE
			// str = 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko';
			// str = 'Mozilla/5.0 (compatible, MSIE 11, Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko';
			// str = 'Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)';
			// str = 'Mozilla/5.0 (Windows; U; MSIE 9.0; Windows NT 9.0; en-US)';
			// str = 'Mozilla/4.0 (MSIE 6.0; Windows NT 5.1)';
			// str = 'Mozilla/4.0 (compatible; MSIE 5.5;)';

			browserInfo = {
				name : 'Internet Explorer',
				version : ie[4]||ie[1],
				cssVendor : 'ms',
				sysStr: ie[3]||ie[2]||'',
			}

		}// 											 1/sys			  			  2/ver							    	  3/ver
		else if( mozilla = navigator.userAgent.match( /\((.+?)(?:(?=.*rv:)[\s;]+rv:([\.\d\w]+)|\)).+?Gecko.+?Firefox[\s\/]?([\w\d\.]+)?/i ) )
		{
			// Firefox
			// str = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:47.0) Gecko/20100101 Firefox/47.0';
			// str = 'Mozilla/5.0 (Windows NT 6.1; U;WOW64; de;rv:11.0) Gecko Firefox/11.0';
			// str = 'Mozilla/5.0 (X11; ; Linux x86_64; rv:1.8.1.6) Gecko/20070802 Firefox';

			browserInfo = {
				name : 'Mozilla Firefox',
				version : mozilla[3]||mozilla[2],
				cssVendor : 'moz',
				sysStr: mozilla[1],
			}

		}//						 	  					   1/sys				2/ver 	|OR|		 3/ver 		  4/sys 	if Version defined			  5/ver
		else if( chrome = navigator.userAgent.match( /(?:\((.+?)\).+?Chrome\/([\d\.\w]+))|Chrome\/([\d\.\w]+).+?\((.+?)\)(?:(?=.*Version\/).+?Version\/([\d\w\.]+)|.*?)/i ) )
		{
			// Chrome
			// str = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36';
			// str = 'Mozilla/5.0 (Windows NT 6.4; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36';
			// str = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1944.0 Safari/537.36';
			// str = 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1667.0 Safari/537.36';
			// str = 'Mozilla/5.0 (X11; CrOS i686 4319.74.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36';
			// str = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.24 (KHTML, like Gecko) Chrome/19.0.1055.1 Safari/535.24';
			// str = 'Chrome/15.0.860.0 (Windows; U; Windows NT 6.0; en-US) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/15.0.860.0';

			browserInfo = {
				name : 'Google Chrome',
				version : chrome[5]||chrome[3]||chrome[2],
				cssVendor : 'webkit',
				sysStr: chrome[4]||chrome[1]||'',
			}

		}// 							1/sys 	  MUST			if we have Version/			  2/ver 		  if we have Safari/		 3/ver
		else if( safari = navigator.userAgent.match( /\((.+?)\).+?AppleWebKit(?:(?=.*Version\/).*?Version\/([\d\w\.]+)|.*?)(?:(?=.*Safari\/).*?Safari\/([\d\w\.]+)|.*?)/i ) ){
			// Safari
			// str= 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A';
			// str = 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; es) AppleWebKit/419 (KHTML, like Gecko) Safari/419.3';
			// str = 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; fr-fr) AppleWebKit/312.1 (KHTML, like Gecko) Safari/312';
			// str = 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en) AppleWebKit (KHTML, like Gecko)';

			browserInfo = {
				name: ( myUtil.isMobile() ) ? 'Android Browser' : 'Safari',
				version : safari[2]||safari[3]||'',
				cssVendor : 'webkit',
				sysStr: safari[1],
			}

		}

		// Determine if webkit browserInfo, in general any webkit should have 'AppleWebKit' string
		if( !browserInfo.webkit && navigator.userAgent.indexOf('AppleWebKit') != -1 ){

			browserInfo['cssVendor'] = 'webkit';
		}

		
		return browserInfo;
	}

	/**
	 * Get Operating System Information Object
	 * 
	 * @return {Object} Operating System Info
	 */
	myUtil.getSystemInfo = function(){

		if( typeof systemInfo !== 'undefined' ) return systemInfo;

		systemInfo = {};

		// Get System String
		if( typeof browserInfo !== 'undefined' )
			// Already have
			systemInfo.str = browserInfo['sysStr'];
		else
			// Get
			systemInfo.str = navigator.userAgent.slice( navigator.userAgent.indexOf( '(' )+1, navigator.userAgent.indexOf( ')' ) );
		
		
		if( myUtil.isMobile() )
		{
			// Mobile Phone
			if( info = systemInfo.str.match( /Android.*?([\d\.]+)(?:(?=.*?Build).+?\b([\w\d\_\-\s]+)\b\sBuild|.*?)/i ) )
			{
				// Android
				systemInfo.osPlatform = 'Android';
				systemInfo.osVersion = info[1];
				systemInfo.mobileName = info[2] || '';
			}
			else if( info = systemInfo.str.match( /((?:iPhone)|(?:iPad)|(?:iPod)).+?OS\s([\d\_\w\.]+)/i ) )
			{
				// iOS
				systemInfo.osPlatform = 'iOS';
				systemInfo.osVersion = info[2].replace( /_/g, '.' );
				systemInfo.mobileName = info[1];
			}
			else if( info = systemInfo.str.match( /Windows\sPhone\s(?:OS\s)?([\d\_\w\.]+)(?:(?=.*?(NOKIA|SAMSUNG|LG)).+?\2(?:(?=.{4,}$).*?\b([\w\d\-\s]+)\b|.*?)|.*?)/i ) )
			{
				// Windows Phone
				systemInfo.osPlatform = 'Windows Phone';
				systemInfo.osVersion = info[1].replace( /_/g, '.' );
				systemInfo.mobileName = info[2] ? info[2] + ( info[3] ? ' ' + info[3] : '' ) 
					: info[3]||'';
			}

		}
		else if( systemInfo.str.indexOf( 'Macintosh' ) !== -1 )
		{
			// Macintosh
			systemInfo.osPlatform = 'Macintosh';

			if( info = systemInfo.str.match( /(\w+)\sMac\sOS\sX\s?([\d_\.]+)?/i ) )
			{
				systemInfo.osVersion = info[2] ? info[2].replace( /_/g, '.' ) : '';

				if( info[1] == 'PPC' )
				{
					systemInfo.isPPC = true;
					systemInfo.isIntel = false;

				}
				else
				{
					systemInfo.isPPC = false;
					systemInfo.isIntel = true;
				}
			}

		}
		else if( systemInfo.str.indexOf( 'Windows' ) !== -1 || systemInfo.str.indexOf( 'compatible' ) !== -1 )
		{
			// Windows
			systemInfo.osPlatform = 'Windows';

			if( info = systemInfo.str.match( /Windows\s(?:NT\s)?([\.\d]+)/i ) )
				systemInfo.osVersion = info[1];
		
		}
		else if( systemInfo.str.indexOf( 'X11' ) !== -1 || systemInfo.str.indexOf( 'Linux' ) !== -1 )
		{
			// Linux
			systemInfo.osPlatform = 'Linux';
		}

		

		return systemInfo;
	}

	/**
	 * Get Numeric Value
	 * @param  {string|Number} 	num expression to get its numeric value
	 * @return {Number}    Numeric value
	 */
	myUtil.toNumber = function( num ){

		n = parseInt(num);

		return ( isNaN(n) ) ? 0 : n;
	}

	/**
	 * Uppercase First Letter
	 * 
	 * @param  {String} str string
	 * @return {String}     string with uppercased first letter
	 */
	myUtil.uCFirst = function( str ){

		return str.charAt(0).toUpperCase() + str.substr( 1 );
	}

	/**
	 * get Camel Case Syntax
	 * 
	 * @param  {string} str string
	 * @return {String}     string in camelCase
	 */
	myUtil.toCamelCase = function( str ){

		str = str.toLowerCase();

		str = str.replace( /[\s\-\_]+(\w)/g, function( fullMatch, fChar ){
			
			// replace all matched by the submatched letter in upercase
			return fChar.toUpperCase();

		} )

		return str;

	}

	/**
	 * Check if Browser Supports property or not
	 * 
	 * @param  {String} 	property 	CSS Property
	 * @return {Bool|String}     Property Supported Syntax or False if not supported
	 */
	myUtil.cssSupport = function( property )
	{
		
		if( typeof supportedStyles == 'undefined' )
			supportedStyles = document.createElement('DIV').style;

		
		// Note (dashed words converted to camelCase automatically while checking supportedStyles with in operator )
		// 1- check nativly
		if( property in supportedStyles ){ return property; }

		// 2- check in camel case
		property = myUtil.toCamelCase( property );
		if( property in supportedStyles ){ return property; }

		// 3- Check with Vendors
		property = myUtil.getBrowserInfo()['cssVendor'] + myUtil.uCFirst( property )
		if( property in supportedStyles ){ return property;	}
		
		// if not of the above stats occurs
		return false;

	}

	/**
	 * Get Page X, Y Offsets ( current scrollbar location )
	 * 
	 * @return {Object} Locations x, y
	 */
	myUtil.getPageOffsets = function()
	{
		pageOffsets = {}
		
		if( window.scrollY == 'undefined' ){

			pageOffsets.x = ( window.pageXOffset == 'undefined' ) ? myUtil.documentElement.scrollLeft : window.pageXOffset;
			pageOffsets.y = ( window.pageYOffset == 'undefined' ) ? myUtil.documentElement.scrollTop : window.pageYOffset;
			
			return pageOffsets;
		}

		return { 'x': window.scrollX , 'y': window.scrollY };
	};

	
	/**
	 * Check if window has Vertical scroll bar or not
	 * 
	 * @return {Boolean} has scrollbar or not
	 */
	myUtil.hasVerticalScroll = function()
	{
		return myUtil.documentElement.scrollHeight > ( window.innerHeight || myUtil.documentElement.clientHeight );
	}

	/**
	 * Check if window has horizontal scroll bar or not
	 * 
	 * @return {Boolean} has scrollbar or not
	 */
	myUtil.hasHorizontalScroll = function()
	{
		return myUtil.documentElement.scrollWidth > ( window.innerWidth || myUtil.documentElement.clientWidth );
	}

	/**
	 * Get Scroll Bar Width
	 * 
	 * @return {integer} scrollbar width in pixels
	 */
	myUtil.getScrollBarWidth = function()
	{
		// check if it was run before
		if( typeof scrollBarWidth != 'undefined' )
			return scrollBarWidth;

		// 1- create ahidden element and append it to body
		var outer = document.createElement('DIV');
		outer.setAttribute( 'style', 'width: 100px; position: absolute; top: "-100px"; visibility: hidden');
		document.body.appendChild( outer );

		var withScroll = outer.offsetWidth,
			inner, withoutScroll;

		outer.style.overflow = 'scroll';
		
		inner = document.createElement('DIV');
		outer.appendChild( inner );
		inner.setAttribute( 'style', 'width: 100%');

		withoutScroll = inner.offsetWidth;

		outer.remove();

		scrollBarWidth = withScroll - withoutScroll;

		scrollBarHalfWidth = scrollBarWidth / 2;

		delete outer, inner, withScroll, withoutScroll;

		return scrollBarWidth;
	}

	/**
	 * Get Scroll Bar Half Width
	 * 
	 * @return {integer} scrollbar Half width in pixels
	 */
	myUtil.getScrollBarHalfWidth = function()
	{
		// check if it was run before
		if( typeof scrollBarHalfWidth != 'undefined' )
			return scrollBarHalfWidth;

		myUtil.getScrollBarWidth();

		return scrollBarHalfWidth;
	
	}

	return myUtil;

})(myUtil || {});


/*---------------------------------------------------------------------------
*								Routes
*---------------------------------------------------------------------------*/
function urlToRoute( name, params )
{
	// 
	if( typeof routes !== 'object' )
	{
		throw Error( 'routes object not defined!.' )
	}
	else if( !routes.hasOwnProperty( name ) )
	{
		throw Error ( 'route name doesn\'t exists' );
	}

	// exists
	route = routes[ name ];

	// route = "destinations/{destinations}/{create}/{id}/tyhtyhy";
	// route = "destination";


	var pattern = new RegExp( '\{.+?\}', 'g' );

	if( matches = route.match( pattern ) )
	{
		// console.log( matches )

		if( typeof params === 'undefined' )
		{
			throw Error( 'route needs parameters .' );
		}
		else if( matches.length > 1 )
		{			
			// more trhan one parameter
			if( ! ( params instanceof Array ) ||  matches.length != params.length )
				
				throw Error( 'route needs ' + matches.length + ' parameters.' );
		}
		else if( !( params instanceof Array ) )
		{
			// convert single parameter to array
			params = [ params ];
		}

		// replace ocuurences
		var i = 0;
		
		route = route.replace( pattern, function(  str ){
			
			return params[ i++ ];
		} )

		
	}

	// Return Route as root not relative
	return baseUrl + '/' + route;

}
/**
 * MyNotifier Constructor ( Class )
 *
 * MyNotifier Constructor Class Lets you Display anice Notifications
 *
 *
 * @package 	MyNotifier
 * @name 		MyNotifier
 * @version 	2.1.0	< 27 Jul 2016 >	
 * @author  	ahmed saad <a7mad.sa3d.2014@gmail.com> <ahmedfadlshaker@gmail.com>
 * @copyright  	2016 ahmed saad
 * @link 		http://plus.google.com/+AhmedSaadGmail
 * @license 	Common Creative
 * 
 */

var MyNotifier = function( options ){

	// if no options return empty object to set Settings
	if( typeof options == 'undefined' )
		return this;

	
	Object.defineProperties( this, {

		notifier: {
			value: {
				$notifier: null,
				parts: {
					// $name: JQ,
				}
			},
			writable: true,
			enumerable: true,
		},

		info: {
			value: {
				key: null,
				isOnScreen: false,
			},
			writable: true,
			enumerable: true,
		},

		hideTimeout: {
			value: null,
			writable: true,
			enumerable: true,
		},

		options: {
			value: null,
			writable: true,
			enumerable: true,
		},

	} );

	this.options = options;

	this.__construct( options );

}

Object.defineProperties( MyNotifier.prototype, {

	$notifierWraper: {
		value: $('<div>', { 'id': 'my-notifier' }),
		writable: true,
		enumerable: true,
	},

	templates: {
		value: {	
			notifier: $('<div>', { 'class': 'notifier' }),
			
			fig: $('<figure>', { 'class': 'notifier-fig' }),
			figImg: $('<img>'),
			figCap: $('<figcaption>'),

			body: $('<div>', { 'class': 'notifier-body' }),
			title: $('<h4>', { 'class': 'notifier-title' }),
			content: $('<p>', { 'class': 'notifier-content' }),

			dismiss: $('<span>', { 'class': 'notifier-dismiss' }),
			link: $('<a>', { 'class': 'notifier-link', 'target': '_blank' }),
		}
	},

	globalInfo: {
		value: {
			isSettingsSetted: false,
			isFiristNotification: true, 	// to append Wraper toBody
			activeNotifications: 0,  // if to animate wraper or notification, #of onscreen notifications
			waitingList: [],				// array of indexes of instances that on queue
			css3Animation: false,
		},
		writable: true,
		enumerable: true,
	},

	settings: {
		value: {
			imgSrc:{
				success: '/src/images/notifier/success.png',
				error: '/src/images/notifier/error.png',
				warning: '/src/images/notifier/warning.png',
				info: '/src/images/notifier/info.png',
			},
			maxNotifications: 2,
			animationDuration: 400,
			dismissTimeout: 7000,
			hoverTimeout: 4000,
			autoDismiss: true,
		},
		writable: true,
		enumerable: true,
	},

	setSettings: {
		value: function( options ){
			// set Settings
			if( this.globalInfo.isSettingsSetted )
			{
				console.log( 'Settings has setted Before' )
				
				return;
			}

			$.extend( this.settings, options );
			
			this.isSetter = true;
			this.globalInfo.isSettingsSetted = true;

			// set cssAnimation
			if( typeof myUtil != 'undefined' )
				this.globalInfo.css3Animation = myUtil.cssSupport('animation');
				
		}
	},

	instances: {
		value: {
			length: 0,
			get: {},
			nextKey: 0,
		},
		enumerable: true,
		writable: true,
	},

	__construct: {
		value: function(){

			// Save Instance
			this.key = this.instances.nextKey++;

			this.instances.get[ this.key ] = this;

			this.instances.length++;

			// Create Notification
			this.create();

		}
	},

	create: {
		value: function(){
			
			// Check if to insert wraper to body
			if( this.globalInfo.isFiristNotification )
			{

				this.$notifierWraper.appendTo('body');

				this.globalInfo.isFiristNotification = false;

				if( window.innerWidth < 768 )
					this.$notifierWraper[0].style.left = ( window.innerWidth-300 )/2 + 'px';

				$(window).on( 'resize', function(){
				
					if( window.innerWidth < 768 )
						this.$notifierWraper.css( 'left', (window.innerWidth-300)/2 + 'px' );
					else
						this.$notifierWraper.css( 'left', '' );

				}.bind(this));
			}
			

			var n = this.notifier.$notifier = this.templates.notifier.clone();
				np = this.notifier.parts;
				
			// Create Figure
			np.fig = this.templates.fig.clone();

			// Create Figure Image
			np.figImg = this.templates.figImg.clone().appendTo( np.fig );

			// if has Image
			if( this.options.imgSrc != null )
			{
				// Bind Error on image src
				np.figImg[0].onerror = function(){
					// src error
					this.onerror = null;

					np.figImg[0].src = this.settings.imgSrc[ this.options.type ];
				
				}.bind(this)

				// assign source
				np.figImg[0].src = this.options.imgSrc;

				// if has Caption
				if( this.options.imgCaption != null )
				{
					np.figCap = this.templates.figCap.clone().appendTo( np.fig );

					// if has image link
					if( this.options.imgLink != null )
						
						np.figCap.append( '<a target="_blank" href="'+ this.options.imgLink +'"">'+ this.options.imgCaption +'</a>' );
					else
						np.figCap.text( this.options.imgCaption );

				}

			} else {
				// Default Image
				np.figImg[0].src = this.settings.imgSrc[ this.options.type ];
			}

			// Create Body
			np.body = this.templates.body.clone();

			// Check Title
			if( this.options.title != null )
				np.title = this.templates.title.clone().text( this.options.title ).appendTo( np.body );

			// Content
			np.content = this.templates.content.clone().append( this.options.content ).appendTo( np.body );
			
			// Check Link
			if( this.options.link != null )
				np.link = this.templates.link.clone().append('<span class="glyphicon glyphicon-new-window"></span>').attr( 'href', this.options.link );

			np.dismiss = this.templates.dismiss.clone().append('&times;');

			// combine
			n.append( np.fig, np.body, np.link, np.dismiss ).prependTo( this.$notifierWraper );

		}
	},

	show: {
		value: function(){

			// check if setter
			if( typeof this.isSetter != 'undefined' )
			{
				// this property is defined only for setter instance
				console.log( 'Setter Instance canot create Notifications!' );
				return;
			}

			/* Ok Show
				NOTE By Default

				- notifier =			display : none 		hidden 		mustbe visible for css3 animation
				- notifierWraper 		display: fixid		visible 	mustbe hidden  for jquery animation
			*/
				
			// Wait asecond then show notifier
			// setTimeout( function(){

				// check if notification is already active
				if( this.info.isOnScreen == true )
				{
					console.log( 'Already on screen' );
					return;
				}

				// if to Queue
				if( this.globalInfo.activeNotifications == this.settings.maxNotifications )
				{
					// Add to Waiting List queue
					if( this.globalInfo.waitingList.indexOf( this.key ) == -1 )
						this.globalInfo.waitingList.push( this.key );

					console.log( 'Max Notifications, Waiting....' );

					return;
				}

				if( this.globalInfo.activeNotifications )
				{
					// animate .nitifier
					this.$notifierWraper.show();

					if( this.globalInfo.css3Animation  )
						this.notifier.$notifier.show().addClass( 'flip-bottom' );
					else
						this.notifier.$notifier.fadeIn( this.settings.animationDuration );

				}else{
					// animate wraper
		
					if( this.globalInfo.css3Animation  )
					{
						this.notifier.$notifier.show();
						this.$notifierWraper.show().addClass( 'flip-bottom' )
					}
					else
					{
						this.$notifierWraper.hide();
						this.notifier.$notifier.show();
						this.$notifierWraper.slideDown( this.settings.animationDuration );
					}
				}

				this.globalInfo.activeNotifications++;

				this.info.isOnScreen = true;
				
				// console.log( 'onscreen notifications now are ', this.globalInfo.activeNotifications )

				this.behaviour();

			// }.bind(this), 10);
			
	
		},
		enumerable: true,
	},

	autoDismiss: {
		value: function( duration ){
			
			duration = ( typeof duration == 'undefined' || duration == 'dismissTimeout' ) ? 'dismissTimeout' : 'hoverTimeout';
			
			// 1- Clear Timeout
			clearTimeout( this.dismissTimeout );

			// 2- setTimeout
			this.dismissTimeout = setTimeout( function(){

				this.dismiss();

			}.bind(this), this.settings[ duration ] );
		}
	},

	dismiss: {
		value: function(){

			// dismiss

			if( this.globalInfo.activeNotifications > 1 )
			{
				// Not Last
				// animate .nitifier
				this.notifier.$notifier.removeClass('flip-bottom').fadeOut( this.settings.animationDuration, function(){
					// Fire Dismissed Event
					this.dismissed();

				}.bind(this) );

			}else{
				// animate wraper
	
				this.$notifierWraper.removeClass('flip-bottom').slideUp( this.settings.animationDuration, function(){
					// Fire Dismissed Event
					this.dismissed();

				}.bind(this) );
			}
			
		},
		enumerable: true,
	},

	dismissed: {
		value: function( isLast ){

			// dismissed

			// clearTimeout
			clearTimeout( this.dismissTimeout );

			// set onscreen to faelse
			this.info.isOnScren = false;
			
			// decrease number of active notifications by 1
			this.globalInfo.activeNotifications--;

			// hide notifications wraper if no notifications active
			if( this.globalInfo.activeNotifications == 0 )
				this.$notifierWraper.hide();

			// console.log( 'dissmissed, notifications onscreen now ', this.globalInfo.activeNotifications )

			// show on waited List if exists
			if( this.globalInfo.waitingList.length )
			{
				index = this.globalInfo.waitingList.shift();

				this.instances.get[ index ].show();
			}

			// Remove event listeners, notification element
			this.removeBehaviour();
			this.notifier.$notifier.remove();

			// clear memory by deleting Refrences
			this.instances.length--;
			delete this.instances.get[ this.info.key ], this;
			
		},
		enumerable: true,
	},

	behaviour: {
		value: function(){

			// dismiss listener
			this.notifier.parts.dismiss.on( 'click', function(){ this.dismiss(); }.bind(this) );
			
			// autoHide
			if( this.settings.autoDismiss === true ){
				
				// Set autoDismis Timeout
				this.autoDismiss();

				// Bind hover Listener
				this.notifier.$notifier.on( {
					'mouseenter': function(){ clearTimeout( this.dismissTimeout ); }.bind(this),
					'mouseleave': function(){ this.autoDismiss( 'hoverTimeout' ) }.bind(this),
				
				});
			}

		},
		enumerable: true,
	},

	removeBehaviour: {
		value: function(){

			// Remove Listeners
			this.notifier.parts.dismiss.off( 'click' );
			
			// Remove hover listeners if was binded
			if( this.settings.autoDismiss === true )
				this.notifier.$notifier.off( 'click, mouseenter, mouseleave' );
		
		},
		enumerable: true,
	},

} );

// Thanks God
// الحمد لله