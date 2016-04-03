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

	Route::group(['prefix' => 'admin'], function() {
		Route::get('pocetna', ['as' => 'admin', 'uses' => 'AdminController@showHome']);


		// users CRUD
		Route::get('korisnici', ['as' => 'korisnici', 'uses' => 'AdminController@showUsers']);
		Route::get('korisnici/uredi/{id}', ['as' => 'korisnici-edit', 'uses' => 'AdminController@showUserEditForm'])->where(['id' => '[\d]+']);
		Route::post('korisnici/uredi/', ['as' => 'korisnici-edit-post', 'uses' => 'AdminController@editUser']);
		Route::get('korisnici/obrisi/{id}', ['as' => 'korisnici-delete', 'uses' => 'AdminController@deleteUser'])->where(['id' => '[\d]+']);
	});
});

/**
 * logout from admin area
 */
Route::get('logout', function(){
	Auth::logout();
	return Redirect::to('/');
});

/**
 * API area
 */
Route::group(['prefix' => 'api'], function() {
	Route::get('users', ['as' => 'apiUsers', 'uses' => 'ApiController@getUsers']);

});

/**
 * public area
 */
Route::post('login', ['as' => 'loginPost', 'uses' => 'LoginController@checkLogin']);
Route::get('login', ['as' => 'login', 'uses' => 'LoginController@showLogin']);
Route::post('register', ['as' => 'registerPost', 'uses' => 'LoginController@checkRegister']);
Route::get('register', ['as' => 'register', 'uses' => 'LoginController@showRegister']);
Route::get('/', ['as' => 'home', 'uses' => 'PublicController@showHome']);
