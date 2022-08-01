<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate([
            'name' => 'Admin',
            'login' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
            'activated' => 1,
        ]);

        $user->permissions()->sync([1,4]);
    }
}
