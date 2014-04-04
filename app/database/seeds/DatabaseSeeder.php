<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$tables = [
			'activations', 'groups', 'groups_users', 'reminders', 'throttle', 'users',
			'places',
			'checkins',
		];

		foreach ($tables as $table)
		{
			DB::table($table)->truncate();
		}

		$this->call('GroupTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('PlaceTableSeeder');
		$this->call('CheckinTableSeeder');
	}

}
