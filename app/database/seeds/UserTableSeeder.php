<?php

class UserTableSeeder extends Seeder {

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
			Sentry::registerAndActivate([
				'email' => $faker->email,
				'password' => 'password',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
			]);
		}
	}

}
