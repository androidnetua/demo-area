<?php

namespace Database\Seeders;

use App\Models\SpecsVendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecsVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendors = [
            ['name' => 'AMD'],
            ['name' => 'Intel'],
            ['name' => 'NVIDIA'],
        ];

        foreach ($vendors as $key => $vendor) {
            $vendor['slug'] = Str::slug($vendor['name']);
            SpecsVendor::create($vendor);
        }
    }
}
