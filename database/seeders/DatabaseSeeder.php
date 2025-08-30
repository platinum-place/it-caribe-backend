<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\CRM\Database\Seeders\CRMDatabaseSeeder;
use Modules\Quote\Database\Seeders\QuoteDatabaseSeeder;
use Modules\Vehicle\Database\Seeders\VehicleDatabaseSeeder;

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
            VehicleDatabaseSeeder::class,
            QuoteDatabaseSeeder::class,
            CRMDatabaseSeeder::class,
        ]);
    }
}
