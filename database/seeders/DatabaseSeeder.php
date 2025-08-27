<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            //            RoleSeeder::class,
            //            AdminUserSeeder::class,
            //
            //            // Vehicle
            //            Vehicle\VehicleUseSeeder::class,
            //            Vehicle\VehicleColorSeeder::class,
            //            Vehicle\VehicleUtilitySeeder::class,
            //            Vehicle\VehicleActivitySeeder::class,
            //            Vehicle\VehicleLoanTypeSeeder::class,
            //            Vehicle\VehicleAccessorySeeder::class,

            // Quote
            Quote\QuoteTypeSeeder::class,
            Quote\QuoteStatusSeeder::class,
            Quote\QuoteLineStatusSeeder::class,
            Quote\Life\QuoteLifeCreditTypeSeeder::class,
            Quote\Fire\QuoteFireConstructionTypeSeeder::class,

            // CRM
            CRM\LeadTypeSeeder::class,
        ]);
    }
}
