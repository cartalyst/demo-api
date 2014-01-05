<?php

use Symfony\Component\HttpKernel\Exception\HttpException;

class PlacesAdminController extends BaseController {

	public function index()
	{
		$places = $this->api('get', 'api/v1/places');

		return View::make('places.index', compact('places'));
	}

	public function edit($id)
	{
		try
		{
			$place = $this->api('get', "api/v1/places/$id");
		}
		catch (HttpException $e)
		{
			return Redirect::to('admin/places')
				->withErrors($e->getMessage());
		}

		return View::make('places.edit', compact('place'));
	}

	public function update($id)
	{
		$validator = Validator::make(Input::get(), [
			'name' => 'required',
			'address' => 'required',
		]);

		if ($validator->fails())
		{
			return Redirect::back()
				->withErrors($validator->errors());
		}

		$place = $this->api('put', "api/v1/places/$id", Input::get());

		return Redirect::to('admin/places')
			->withSuccess("Place [{$place['name']}] has successfully been updated.");
	}

	public function delete($id)
	{
		try
		{
			$place = $this->api('delete', "api/v1/places/$id");
		}
		catch (HttpException $e)
		{
			return Redirect::to('admin/places')
				->withErrors($e->getMessage());
		}

		return Redirect::to('admin/places')
			->withSuccess("Place has successfully been deleted.");
	}
}
