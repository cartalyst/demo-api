<?php

use Cartalyst\Sentry\Checkpoints\ThrottlingException;

class AuthController extends BaseController {

	public function showLogin()
	{
		return View::make('auth.login');
	}

	public function processLogin()
	{
		$rules = [
			'email' => 'required|email',
			'password' => 'required',
		];

		$errors = Validator::make(Input::get(), $rules)->errors();

		if (count($errors) > 0)
		{
			return Redirect::back()
				->withInput()
				->withErrors($errors);
		}

		try
		{
			$user = Sentry::authenticate(Input::get());
		}
		catch (ThrottlingException $e)
		{
			return Redirect::back()
				->withErrors($e->getMessage());
		}

		if ($user)
		{
			return Redirect::intended()
				->withSuccess('Welcome, you have successfully logged in.');
		}
		else
		{
			return Redirect::back()
				->withErrors('Invalid username or password.');
		}
	}

	public function logout()
	{
		Sentry::logout();

		return Redirect::route('login')
			->withSuccess('You have successfully logged out.');
	}

}
