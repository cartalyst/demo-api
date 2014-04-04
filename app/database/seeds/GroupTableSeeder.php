<?php

class GroupTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'slug' => 'admin',
            'name' => 'Admin',
            'permissions' => [
                'checkins.*' => true,
                'places.*'    => true,
            ],
        ]);

        Group::create([
            'slug' => 'privileged',
            'name' => 'Privileged',
            'permissions' => [
                'checkins.*' => true,
                'places.list' => true,
                'places.edit' => true,
            ],
        ]);

        Group::create([
            'slug' => 'standard',
            'name' => 'Standard',
            'permissions' => [
                'checkins.list' => true,
            ],
        ]);
    }

}
