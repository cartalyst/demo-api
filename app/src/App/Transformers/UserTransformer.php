<?php namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use User;

class UserTransformer extends TransformerAbstract
{
	protected $availableIncludes = [
		'checkins',
	];

	/**
	 * Turn this item object into a generic array
	 *
	 * @return array
	 */
	public function transform(User $user)
	{
		return [
			'id'         => $user->id,
			'email'      => $user->email,
			'first_name' => $user->first_name,
			'first_name' => $user->first_name,
			'created_at' => (string) $user->created_at,
		];
	}

	/**
	 * Embed Checkins
	 *
	 * @return League\Fractal\Resource\Collection
	 */
	public function includeCheckins(User $user)
	{
		$checkins = $user->checkins;

		return $this->collection($checkins, new CheckinTransformer);
	}

}
