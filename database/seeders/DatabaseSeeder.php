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

            \Modules\Infrastructure\CRM\Persistence\Seeders\DatabaseSeeder::class,
            \Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders\DatabaseSeeder::class,

            \Modules\Infrastructure\Quotations\Core\Persistence\Seeders\DatabaseSeeder::class,
            \Modules\Infrastructure\Quotations\Products\Fire\Persistence\Seeders\DatabaseSeeder::class,
            \Modules\Infrastructure\Quotations\Products\Life\Persistence\Seeders\DatabaseSeeder::class,
            \Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Seeders\DatabaseSeeder::class,

            \Modules\Infrastructure\API\Zoho\Persistence\Seeders\DatabaseSeeder::class,

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
