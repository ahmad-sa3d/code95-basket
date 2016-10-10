<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group( [ 'middleware'=>'auth' ], function(){

	Route::get( '/', 'HomeController@index')->name('home');
	Route::post( '/order', 'HomeController@openOrder')->name('order.open');
	Route::post( '/order-confirm', 'HomeController@confirmOrder')->name('order.confirm');
	Route::put( '/order', 'HomeController@updateOrder')->name('order.update');
	Route::delete( '/order', 'HomeController@destroyOrder')->name('order.destroy');
	Route::get( '/invoice/{invoice}', 'HomeController@invoice')->name('invoice');

	Route::group( [ 'prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware'=> 'admin' ], function(){

		// Admin Dashboard
		Route::get( '/', [ 'uses' => 'DashboardController@index' ])->name('dashboard');

		Route::get( '/dashboard', function(){
			return redirect()->route( 'admin.dashboard' );
		} );

		Route::get( '/doc', function(){
			return view( 'admin.doc' );
		} )->name( 'doc' );

		// ------------------------------ Shop Data Entries ------------------------------ 
		// Products
		Route::get( 'products/{product}/delete', ['uses' => 'ProductsController@delete'] )->name('products.delete');
		Route::get( 'products/search', ['uses' => 'ProductsController@search'] )->name('products.search');
		Route::resource( 'products', 'ProductsController' );
		
		// Categories
		Route::get( 'categories/{category}/delete', ['uses' => 'CategoriesController@delete'] )->name('categories.delete');
		Route::get( 'categories/search', ['uses' => 'CategoriesController@search'] )->name('categories.search');
		Route::resource( 'categories', 'CategoriesController' );

		// ------------------------------- System Configs ------------------------------- 
		// User
		Route::get( 'users/{user}/delete', ['uses' => 'UsersController@delete'] )->name('users.delete');
		Route::patch( 'users/{user}/settings', ['uses' => 'UsersController@updateSettings'] )->name('users.update-settings');
		Route::resource( 'users', 'UsersController' );

		// ------------------------------- Transactions Entries ------------------------------- 
		// Invoices
		Route::get( 'invoices/{invoice}/delete', ['uses' => 'InvoicesController@delete'] )->name('invoices.delete');
		Route::resource( 'invoices', 'InvoicesController' );

	} );

} );


// ------------------------------- Authentication Routes ------------------------------- 
Auth::routes();
