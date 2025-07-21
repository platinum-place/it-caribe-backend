<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            VehicleActivitySeeder::class,
            VehicleUseSeeder::class,
            VehicleAccessorySeeder::class,
            VehicleColorSeeder::class,
        ]);
    }
}
