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
