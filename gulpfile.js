const elixir = require('laravel-elixir');

require('laravel-elixir-vue');


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

// Disable Elixir Maps
elixir.config.sourcemaps = false;

elixir(mix => {
    
    mix.styles( [
	    	'bootstrap/bootstrap.css',
	    	'bootstrap/bootstrap-theme.css',
	    	'font-awesome.css',
	    	// 'fonts.css',
	    	// 'my/mymodal.css',
	    	'my/mynotifier.css',
	    	'main.css'
    	], 'public/css/all.css' )

    	.styles( [
	   		'./resources/assets/css/selectize/selectize.css',
	   		'./resources/assets/css/selectize/selectize.bootstrap3.css',
   		], 'public/css/selectize.min.css' )

    	// Merge Libraries ToGether
    	.webpack( [
			'app/jquery/jquery.js',
	       	'app/plugins/jquery.slimscroll.min.js',
	       	'app/bootstrap/bootstrap.js',
		], 'public/js/libraries_.js' )

       // Merge My Javascripts
       .scripts( [
	       	'app/my/myutil.js',
	       	// 'app/my/myevent.js',
	       	// 'app/my/mymodal.js',
	       	'app/my/mynotifier.js',
       	], 'public/js/my_.js' )

    
    	// Merge the result of the previous results into one file 'all.js'
       .combine( [
	   		'./public/js/libraries_.js',
	   		'./public/js/my_.js',
	   		// './resources/assets/js/app/script.js',
   		], 'public/js/all.js' )


	   // Merge Moment Time, datetimepicker
	   .combine( [
	   		'./resources/assets/js/app/plugins/datetime/moment/moment.min.js',
	   		'./resources/assets/js/app/plugins/datetime/moment/ar.js',
	   		'./resources/assets/js/app/plugins/datetime/bootstrap-datetimepicker.min.js',
   		], 'public/js/bootstrap-datetimepicker.min.js' )


   		// Seperated Files That Are Needed For Some Views Only
   	   // .scripts( 'app/captcha.js', 'public/js/captcha.min.js' )
   	   .scripts( 'app/my/rcswitcher.js', 'public/js/rcswitcher.min.js' )
   	   .styles( 'my/rcswitcher.css', 'public/css/rcswitcher.min.css' )
   	   .scripts( 'app/script.js', 'public/js/script.min.js' )
   	   .scripts( 'app/plugins/jquery.print.js', 'public/js/jquery.print.min.js' )
   	   .scripts( 'app/basket.js', 'public/js/basket.min.js' )
   	   
   	   // Just Copy Minified
   	   .copy( './resources/assets/css/bootstrap-datetimepicker.min.css', 'public/css/bootstrap-datetimepicker.min.css' )
   	   .copy( './resources/assets/js/app/plugins/selectize.min.js', 'public/js/selectize.min.js' )
});
