<?php namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Place;

class PlaceTransformer extends TransformerAbstract {

	protected $availableEmbeds = [
		'checkins',
	];

	/**
	 * {@inheritDoc}
	 */
	public function transform(Place $place)
	{
		return [
			'id'         => $place->id,
			'name'       => $place->name,
			'address'    => $place->address,
			'created_at' => (string) $place->created_at,
		];
	}

	/**
	 * {@inheritDoc}
	 */
	public function embedCheckins(Place $place)
	{
		$checkins = $place->checkins;

		return $this->collection($checkins, new CheckinTransformer);
	}

}
