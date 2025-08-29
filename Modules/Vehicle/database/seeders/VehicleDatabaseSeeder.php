<?php

namespace Modules\Vehicle\Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            VehicleUseSeeder::class,
            VehicleColorSeeder::class,
            VehicleUtilitySeeder::class,
            VehicleActivitySeeder::class,
            VehicleLoanTypeSeeder::class,
            VehicleAccessorySeeder::class,
        ]);
    }
}
