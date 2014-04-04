<?php

use Symfony\Component\HttpKernel\Exception\HttpException;

class PlacesAdminController extends BaseController {

	public function index()
	{
		if ( ! $this->checkAccess('places.list'))
		{
			return Redirect::to('/')->withErrors('You don\'t have access to list.');
		}

		$places = $this->api('get', 'api/v1/places');

		return View::make('places.index', compact('places'));
	}

	public function edit($id)
	{
		if ( ! $this->checkAccess('places.edit'))
		{
			return Redirect::to('admin/places')->withErrors('You aren\'t allowed to edit places.');
		}

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
		if ( ! $this->checkAccess('places.update'))
		{
			return Redirect::back()->withErrors('You aren\'t allowed to edit places.');
		}

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
		if ( ! $this->checkAccess('places.delete'))
		{
			return Redirect::back()->withErrors('You aren\'t allowed to delete places.');
		}

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
