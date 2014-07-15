<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$admin = Group::whereSlug('admin')->first();
		$user = Sentinel::registerAndActivate([
			'email'      => 'admin@example.com',
			'password'   => 'password',
			'first_name' => 'Dan',
			'last_name'  => 'Syme',
		]);
		$user->groups()->attach($admin);

		$privileged = Group::whereSlug('privileged')->first();
		$user = Sentinel::registerAndActivate([
			'email'      => 'privileged@example.com',
			'password'   => 'password',
			'first_name' => 'Ben',
			'last_name'  => 'Corlett',
		]);
		$user->groups()->attach($privileged);

		$standard = Group::whereSlug('standard')->first();

		$faker = Faker\Factory::create();

		for ($i = 0; $i < 10; $i++)
		{
			$user = Sentinel::registerAndActivate([
				'email' => $faker->email,
				'password' => 'password',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
			]);
			$user->groups()->attach($standard);
		}
	}

}
