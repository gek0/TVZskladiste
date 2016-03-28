<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * admin area
 */
Route::group(['before' => 'auth'], function() {
	Route::get('admin', function(){
		return Redirect::to('admin/pocetna');
	});
	Route::get('admin/pocetna', ['as' => 'admin', 'uses' => 'AdminController@showHome']);

});

/**
 * logout from admin area
 */
Route::get('logout', function(){
	Auth::logout();
	return Redirect::to('/');
});

/**
 * public area
 */
Route::post('login', ['as' => 'loginPost', 'uses' => 'LoginController@checkLogin']);
Route::get('login', ['as' => 'login', 'uses' => 'LoginController@showLogin']);
Route::post('register', ['as' => 'registerPost', 'uses' => 'LoginController@checkRegister']);
Route::get('register', ['as' => 'register', 'uses' => 'LoginController@showRegister']);
Route::get('/', ['as' => 'home', 'uses' => 'PublicController@showHome']);