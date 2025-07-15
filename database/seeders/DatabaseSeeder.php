<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Quotes\QuotesSeeder;
use Database\Seeders\Vehicles\VehiclesSeeder;
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
            // PermissionSeeder::class,
            AdminUserSeeder::class,
            QuotesSeeder::class,
            VehiclesSeeder::class,
        ]);
    }
}
