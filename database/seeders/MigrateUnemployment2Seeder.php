<?php

namespace Database\Seeders;

use App\Imports\Migrate\Unemployment2\MigrateUnemployment2;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class MigrateUnemployment2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = base_path('migrate/Consolidado Desempleo Unico Pago Julio 2025.xlsx');

        Excel::import(new MigrateUnemployment2, $path);
    }
}
