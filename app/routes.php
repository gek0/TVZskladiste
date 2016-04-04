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

		// items CRUD
		Route::get('proizvodi', ['as' => 'items', 'uses' => 'ItemController@showItems']);

		// user orders CRUD
		Route::get('moje-narudzbe', ['as' => 'my-orders', 'uses' => 'OrderController@showMyOrders']);

		// category CRUD
		Route::get('kategorije', ['as' => 'category-list', 'uses' => 'CategoryController@showCategories']);
		Route::post('kategorije/nova', ['as' => 'category-add-post', 'uses' => 'CategoryController@addCategory']);
		Route::post('kategorije/uredi', ['as' => 'category-edit-post', 'uses' => 'CategoryController@editCategory']);
		Route::get('kategorije/uredi/{id}', ['as' => 'category-edit', 'uses' => 'CategoryController@showCategoryEditForm'])->where(['id' => '[\d]+']);
		Route::get('kategorije/obrisi/{id}', ['as' => 'category-delete', 'uses' => 'CategoryController@deleteCategory'])->where(['id' => '[\d]+']);

		// all orders CRUD
		Route::get('narudzbe', ['as' => 'orders', 'uses' => 'OrderController@showAllUsersOrders']);

		// status
		Route::get('stanje', ['as' => 'status', 'uses' => 'AdminController@showStatus']);

		// users CRUD
		Route::get('korisnici', ['as' => 'users', 'uses' => 'UserController@showUsers']);
		Route::post('korisnici/uredi', ['as' => 'users-edit-post', 'uses' => 'UserController@editUser']);
		Route::get('korisnici/uredi/{id}', ['as' => 'users-edit', 'uses' => 'UserController@showUserEditForm'])->where(['id' => '[\d]+']);
		Route::get('korisnici/obrisi/{id}', ['as' => 'users-delete', 'uses' => 'UserController@deleteUser'])->where(['id' => '[\d]+']);
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
	Route::get('/', ['as' => 'api', 'uses' => 'ApiController@showApi']);
	Route::get('users', ['as' => 'apiUsers', 'uses' => 'ApiController@getUsers']);
	Route::get('categories', ['as' => 'apiCategories', 'uses' => 'ApiController@getCategories']);
});

/**
 * public area
 */
Route::post('login', ['as' => 'loginPost', 'uses' => 'LoginController@checkLogin']);
Route::get('login', ['as' => 'login', 'uses' => 'LoginController@showLogin']);
Route::post('register', ['as' => 'registerPost', 'uses' => 'LoginController@checkRegister']);
Route::get('register', ['as' => 'register', 'uses' => 'LoginController@showRegister']);
Route::get('/', ['as' => 'home', 'uses' => 'PublicController@showHome']);
