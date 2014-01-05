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

Route::get('/', function()
{
	return View::make('hello');
});

Route::group(['prefix' => 'admin'], function()
{
	Route::get('places', 'PlacesAdminController@index');
	Route::get('places/{id}/edit', 'PlacesAdminController@edit');
	Route::post('places/{id}/edit', 'PlacesAdminController@update');
	Route::get('places/{id}/delete', 'PlacesAdminController@delete');
});

Route::group(['prefix' => 'api/v1'], function()
{
	Route::get('places', 'PlacesApiController@index');
	Route::get('places/{id}', 'PlacesApiController@show');
	Route::put('places/{id}', 'PlacesApiController@update');
	Route::delete('places/{id}', 'PlacesApiController@destroy');
});

Route::group(['prefix' => 'fbingha'], function()
{
	Route::get('ui', function()
	{
		var_dump(['Main input', Input::all()]);

		// If you would like to buid up query string data, at this stage, you
		// should build the string. I may switch it before we go stable to
		// be the second parmaeter of GET methods, but this is encouring
		// people to build shitty APIs that are defining endpoints by
		// query strings. A better REST api would have endpoints like
		// /users/:id/checkins/:id/place etc... But, just for arguments
		// sake, let's append a query string.
		$response = API::get('fbingha/api?foo=bar');

		// $response->isSuccessful() etc, this replaces built-in exceptions.
		// See ApiController and BaseController for how I'm masking it in
		// this specific demo, however that's not the job of the API
		// package but rather the implementer. Also see how we're
		// wrapping the getData() method in the BaseController
		// if you would like to do it that way.
		$data = $response->getData();

		if ( ! $response->isSuccessful())
		{
			throw new \RuntimeException("Straighten up mate.");
		}

		var_dump($response->getStatusCode());
		var_dump($data);
	});

	Route::get('api', function()
	{
		var_dump(['Sub input', Input::all()]);

		return new ApiResponse([
			'id' => 14,
			'name' => 'Ben Corlett',
			'created_at' => Carbon\Carbon::now(),
		]);
	});
});
