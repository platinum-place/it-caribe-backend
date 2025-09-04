<?php

namespace Database\Seeders;

use App\Imports\Migrate\Fire\MigrateFire;
use App\Imports\Migrate\Unemployment\MigrateUnemployment;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class MigrateUnemploymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = base_path('migrate/Consolidado Desempleo Mensual Julio 2025.xlsx');

        Excel::import(new MigrateUnemployment, $path);
    }
}
