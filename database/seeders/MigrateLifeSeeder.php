<?php

namespace Database\Seeders;

use Database\Seeders\Migrate\Life\Sheet1Seeder;
use Database\Seeders\Migrate\Life\Sheet2Seeder;
use Database\Seeders\Migrate\Life\Sheet3Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MigrateLifeSeeder extends Seeder
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
        ]);
    }
}
