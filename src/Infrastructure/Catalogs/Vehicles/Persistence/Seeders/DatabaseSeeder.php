<?php

namespace Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Infrastructure\CRM\Persistence\Seeders\LeadTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            VehicleAccessorySeeder::class,
            VehicleActivitySeeder::class,
            VehicleColorSeeder::class,
            VehicleLoanTypeSeeder::class,
            VehicleTypeSeeder::class,
            VehicleUtilitySeeder::class,
            VehicleUseSeeder::class,
            VehicleMakeSeeder::class,
            VehicleModelSeeder::class,
        ]);
    }
}
