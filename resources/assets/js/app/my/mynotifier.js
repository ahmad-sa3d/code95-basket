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