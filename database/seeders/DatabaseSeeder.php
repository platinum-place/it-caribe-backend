<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use old\Modules\CRM\database\seeders\CRMDatabaseSeeder;
use old\Modules\Quote\database\seeders\QuoteDatabaseSeeder;
use old\Modules\Vehicle\database\seeders\VehicleDatabaseSeeder;

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
