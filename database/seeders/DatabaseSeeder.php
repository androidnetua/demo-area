<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'manage-users'],
            ['name' => 'edit-news'],
            ['name' => 'edit-reviews'],
            ['name' => 'specs'],
        ];

        foreach ($permissions as $permission)
            \App\Models\Permission::create($permission);

        $this->call([
            AdminSeeder::class,
            SpecsVendorSeeder::class,
        ]);

        if(config('app.debug'))
            \App\Models\User::factory(3)->create();


    }
}
