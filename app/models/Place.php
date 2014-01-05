<?php

class Place extends Eloquent {

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'places';

	/**
	 * {@inheritDoc}
	 */
	protected $fillable = ['name', 'address'];

	/**
	 * {@inheritDoc}
	 */
	protected static function boot()
	{
		parent::boot();

		static::deleted(function($place)
		{
			foreach ($place->checkins as $checkin)
			{
				$checkin->delete();
			}
		});
	}

	public function checkins()
	{
		return $this->hasMany('Checkin');
	}

	public function getIdAttribute($id)
	{
		return (int) $id;
	}

}
