<?php

namespace Database\Seeders\Vehicles;

use Database\Seeders\Quotes\QuoteStatusSeeder;
use Database\Seeders\Quotes\QuoteTypeSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
