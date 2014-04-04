<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		if ( ! $this->checkAccess('checkins.list'))
		{
			App::abort(404, 'Sorry, but you are not even assigned to the standard group. Something went wrong and the world will probably end tonight.');
		}

		$checkins = Checkin::with(['place', 'user'])->orderBy('created_at', 'desc')->get();

		return View::make('welcome')->withCheckins($checkins);
	}

}
