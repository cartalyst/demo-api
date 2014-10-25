<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$admin = Role::whereSlug('admin')->first();
		$user = Sentinel::registerAndActivate([
			'email'      => 'admin@example.com',
			'password'   => 'password',
			'first_name' => 'Dan',
			'last_name'  => 'Syme',
		]);
		$user->roles()->attach($admin);

		$privileged = Role::whereSlug('privileged')->first();
		$user = Sentinel::registerAndActivate([
			'email'      => 'privileged@example.com',
			'password'   => 'password',
			'first_name' => 'Ben',
			'last_name'  => 'Corlett',
		]);
		$user->roles()->attach($privileged);

		$standard = Role::whereSlug('standard')->first();

		$faker = Faker\Factory::create();

		for ($i = 0; $i < 10; $i++)
		{
			$user = Sentinel::registerAndActivate([
				'email' => $faker->email,
				'password' => 'password',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
			]);
			$user->roles()->attach($standard);
		}
	}

}
