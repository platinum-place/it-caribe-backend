<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders\VehicleAccessorySeeder;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders\VehicleActivitySeeder;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders\VehicleColorSeeder;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders\VehicleLoanTypeSeeder;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders\VehicleMakeSeeder;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders\VehicleModelSeeder;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders\VehicleTypeSeeder;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders\VehicleUseSeeder;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders\VehicleUtilitySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminUserSeeder::class,

            \Modules\Infrastructure\CRM\Persistence\Seeders\DatabaseSeeder::class,
            \Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders\DatabaseSeeder::class,

            QuoteUnemploymentEmploymentTypeSeeder::class,
            QuoteTypeSeeder::class,
            QuoteStatusSeeder::class,
            QuoteLineStatusSeeder::class,
            QuoteLifeCreditTypeSeeder::class,
            QuoteFireRiskTypeSeeder::class,
            QuoteFireCreditTypeSeeder::class,
            QuoteFireConstructionTypeSeeder::class,
            QuoteUnemploymentPaymentTypeSeeder::class,

            \Modules\Infrastructure\Zoho\Persistence\Seeders\DatabaseSeeder::class,

            UserSeeder::class,
            PassportSeeder::class,
        ]);
    }
}
