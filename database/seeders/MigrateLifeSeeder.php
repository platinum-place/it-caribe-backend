<?php

namespace Database\Seeders;

use App\Imports\Migrate\Life\MigrateLife;
use Database\Seeders\Migrate\Life\Sheet1Seeder;
use Database\Seeders\Migrate\Life\Sheet2Seeder;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

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
        ]);

        $path = base_path('migrate/Consolidado Vida Consumo Julio 2025.xlsx');

        Excel::import(new MigrateLife, $path);
    }
}
