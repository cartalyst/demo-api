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

Route::get('/', ['uses' => 'HomeController@showWelcome', 'before' => 'auth']);

Route::get('login', ['uses' => 'AuthController@showLogin', 'as' => 'login']);
Route::post('login', 'AuthController@processLogin');
Route::get('logout', 'AuthController@logout');

Route::group(['prefix' => 'admin', 'before' => 'auth'], function()
{
	Route::get('places', 'PlacesAdminController@index');
	Route::get('places/{id}/edit', 'PlacesAdminController@edit');
	Route::post('places/{id}/edit', 'PlacesAdminController@update');
	Route::get('places/{id}/delete', 'PlacesAdminController@delete');
});

Route::group(['prefix' => 'api/v1', 'before' => 'auth.basic'], function()
{
	Route::get('places', ['uses' => 'PlacesApiController@index', 'as' => 'places.index']);
	Route::get('places/{id}', ['uses' => 'PlacesApiController@show', 'as' => 'places.show']);
	Route::put('places/{id}', ['uses' => 'PlacesApiController@update', 'as' => 'places.update']);
	Route::delete('places/{id}', ['uses' => 'PlacesApiController@destroy', 'as' => 'places.destroy']);
});

Route::get('cheatsheet', function()
{
    $users = User::with('groups')->get();
    $places = Place::get();

    return View::make('cheatsheet')
        ->withUsers($users)
        ->withPlaces($places);
});
