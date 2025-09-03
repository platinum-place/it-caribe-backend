<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Infrastructure\Quotations\Core\Persistence\Seeders\QuoteLineStatusSeeder;
use Modules\Infrastructure\Quotations\Core\Persistence\Seeders\QuoteStatusSeeder;
use Modules\Infrastructure\Quotations\Core\Persistence\Seeders\QuoteTypeSeeder;
use Modules\Infrastructure\Quotations\Products\Fire\Persistence\Seeders\QuoteFireConstructionTypeSeeder;
use Modules\Infrastructure\Quotations\Products\Fire\Persistence\Seeders\QuoteFireCreditTypeSeeder;
use Modules\Infrastructure\Quotations\Products\Fire\Persistence\Seeders\QuoteFireRiskTypeSeeder;
use Modules\Infrastructure\Quotations\Products\Life\Persistence\Seeders\QuoteLifeCreditTypeSeeder;
use Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Seeders\QuoteUnemploymentEmploymentTypeSeeder;
use Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Seeders\QuoteUnemploymentPaymentTypeSeeder;

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

            \Modules\Infrastructure\Quotations\Core\Persistence\Seeders\DatabaseSeeder::class,
            \Modules\Infrastructure\Quotations\Products\Fire\Persistence\Seeders\DatabaseSeeder::class,
            \Modules\Infrastructure\Quotations\Products\Life\Persistence\Seeders\DatabaseSeeder::class,
            \Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Seeders\DatabaseSeeder::class,

            \Modules\Infrastructure\Zoho\Persistence\Seeders\DatabaseSeeder::class,

            /**
             * Migrate TODO
             */
            UserSeeder::class,
            PassportSeeder::class,
            VehicleTypeSeeder::class,
            VehicleMakeSeeder::class,
            VehicleModelSeeder::class,
        ]);
    }
}
