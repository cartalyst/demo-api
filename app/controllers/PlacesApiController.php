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
		$place = Place::find($id);

		if ( ! $place)
		{
			return $this->responseWithErrors("The requested place [$id] does not exist.", 404);
		}

		$place->delete();

		return $this->responseWithNoContent();
	}

}
