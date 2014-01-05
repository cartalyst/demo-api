<?php

class PlaceTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		for ($i = 0; $i < 10; $i++)
		{
			Place::create([
				'name' => $faker->company,
				'address' => $faker->address,
			]);
		}
	}

}
