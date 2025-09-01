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
            RoleSeeder::class,
            AdminUserSeeder::class,
            LeadTypeSeeder::class,
            VehicleAccessorySeeder::class,
            VehicleColorSeeder::class,
            VehicleUseSeeder::class,
            VehicleActivitySeeder::class,
            VehicleLoanTypeSeeder::class,
            VehicleUtilitySeeder::class,
            ZohoOauthClientSeeder::class,
            ZohoOauthRefreshTokenSeeder::class,
            QuoteUnemploymentEmploymentTypeSeeder::class,
            QuoteTypeSeeder::class,
            QuoteStatusSeeder::class,
            QuoteLineStatusSeeder::class,
            QuoteLifeCreditTypeSeeder::class,
            QuoteFireRiskTypeSeeder::class,
            QuoteFireCreditTypeSeeder::class,
            QuoteFireConstructionTypeSeeder::class,
            QuoteUnemploymentPaymentTypeSeeder::class,

            VehicleTypeSeeder::class,
            VehicleMakeSeeder::class,
            VehicleModelSeeder::class,
            UserSeeder::class,
            PassportSeeder::class,
        ]);
    }
}
