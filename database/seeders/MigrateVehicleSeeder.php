<?php

namespace Database\Seeders;

use Database\Seeders\Migrate\Vehicle\Sheet1Seeder;
use Database\Seeders\Migrate\Vehicle\Sheet2Seeder;
use Database\Seeders\Migrate\Vehicle\Sheet3Seeder;
use Database\Seeders\Migrate\Vehicle\Sheet4Seeder;
use Database\Seeders\Migrate\Vehicle\Sheet5Seeder;
use Database\Seeders\Migrate\Vehicle\Sheet6Seeder;
use Database\Seeders\Migrate\Vehicle\Sheet7Seeder;
use Database\Seeders\Migrate\Vehicle\Sheet8Seeder;
use Database\Seeders\Migrate\Vehicle\Sheet9Seeder;
use Database\Seeders\Migrate\Vehicle\Sheet10Seeder;
use Database\Seeders\Migrate\Vehicle\Sheet11Seeder;
use Database\Seeders\Migrate\Vehicle\Sheet12Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MigrateVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            Sheet1Seeder::class,
            Sheet2Seeder::class,
            Sheet3Seeder::class,
            Sheet4Seeder::class,
            Sheet5Seeder::class,
            Sheet6Seeder::class,
            Sheet7Seeder::class,
            Sheet8Seeder::class,
            Sheet9Seeder::class,
            Sheet10Seeder::class,
            Sheet11Seeder::class,
            Sheet12Seeder::class,
        ]);
    }
}
