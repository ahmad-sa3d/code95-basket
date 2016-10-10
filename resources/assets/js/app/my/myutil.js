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