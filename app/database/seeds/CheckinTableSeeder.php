<?php

class CheckinTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		$users = User::with('roles')->whereHas('roles', function($query)
		{
			$query->whereSlug('standard');
		})->get();
		$usersList = $users->lists('id');

		$places = Place::all();
		$placesList = $places->lists('id');

		for ($i = 0; $i < 50; $i++)
		{
			$user = $users->find($usersList[array_rand($usersList)]);
			$place = $places->find($placesList[array_rand($placesList)]);

			$checkin = new Checkin([
				'snapshot' => 'http://placehold.it/500/'.substr($faker->hexcolor, 1).'&text='.str_replace(' ', '+', $faker->catchPhrase),
			]);
			$checkin->user()->associate($user);
			$checkin->place()->associate($place);
			$checkin->save();
		}
	}

}
