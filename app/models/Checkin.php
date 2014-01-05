<?php

class Checkin extends Eloquent {

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'checkins';

	public function place()
	{
		return $this->belongsTo('Place');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function getIdAttribute($id)
	{
		return (int) $id;
	}

}
