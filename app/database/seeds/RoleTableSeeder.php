<?php

class RoleTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'slug' => 'admin',
            'name' => 'Admin',
            'permissions' => [
                'checkins.*' => true,
                'places.*'    => true,
            ],
        ]);

        Role::create([
            'slug' => 'privileged',
            'name' => 'Privileged',
            'permissions' => [
                'checkins.*' => true,
                'places.list' => true,
                'places.edit' => true,
            ],
        ]);

        Role::create([
            'slug' => 'standard',
            'name' => 'Standard',
            'permissions' => [
                'checkins.list' => true,
            ],
        ]);
    }

}
