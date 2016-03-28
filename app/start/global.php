<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	switch ($code){
		case 403:
			$exception_message = 'Nemate ovlasti pristupa.';
			return Response::view('error', ['exception' => $exception_message, 'page_title' => $code], 403);
			break;

		case 503:
			$exception_message = 'Poteškoće sa serverom. Pokušajte ponovo kasnije.';
			return Response::view('error', ['exception' => $exception_message, 'page_title' => $code], 503);
			break;

		default:
			Log::error($exception);
	}
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Poteškoće sa serverom. Pokušajte ponovo kasnije.", 503);
});

/*
|--------------------------------------------------------------------------
| Route Not Found Handler
|--------------------------------------------------------------------------
|
| If no controller for intended route is found, send 404 error code
|
*/

App::missing(function($exception)
{
	if(getenv('APP_ENV') == 'production') {
		return Response::view('error', ['exception' => 'Stranica nije pronađena.', 'page_title' => '404'], 404);
	}
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';
require app_path().'/functions.php';
require app_path().'/validators.php';

/**
 * @default 'page'
 * change laravel paginator page name
 */
Paginator::setPageName('stranica');
