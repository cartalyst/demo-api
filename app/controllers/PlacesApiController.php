<?php

use App\Transformers\PlaceTransformer;

class PlacesApiController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if ( ! $this->checkAccess('places.list'))
		{
			return $this->responseWithErrors('Sorry, you are not allowed to list places.', 403);
		}

		$places = Place::all();

        return $this->respondWithCollection($places, new PlaceTransformer);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if ( ! $this->checkAccess('places.show'))
		{
			return $this->responseWithErrors('Sorry, you are not allowed to show places.', 403);
		}

		$place = Place::find($id);

		if ( ! $place)
		{
			return $this->responseWithErrors("The requested place [$id] does not exist.", 404);
		}

		return $this->respondWithItem($place, new PlaceTransformer);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if ( ! $this->checkAccess('places.update'))
		{
			return $this->responseWithErrors('Sorry, you are not allowed to edit places.', 403);
		}

		$validator = Validator::make(Input::json()->all(), [
			'name' => 'required',
			'address' => 'required',
		]);

		if ($validator->fails())
		{
			return $this->responseWithErrors($validator->errors()->all(), 422);
		}

		$place = Place::find($id);
		$place->fill(Input::json()->all());
		$place->save();

		return $this->respondWithItem($place, new PlaceTransformer);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ( ! $this->checkAccess('places.delete'))
		{
			return $this->responseWithErrors('Sorry, you are not allowed to delete places.', 403);
		}

		$place = Place::find($id);

		if ( ! $place)
		{
			return $this->responseWithErrors("The requested place [$id] does not exist.", 404);
		}

		$place->delete();

		return $this->responseWithNoContent();
	}

}
