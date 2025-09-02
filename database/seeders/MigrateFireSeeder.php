<?php

namespace Database\Seeders;

use App\Imports\Migrate\Fire\MigrateFire;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class MigrateFireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = base_path('migrate/Consolidado Incendio Hipotecario Julio 2025.xlsx');

        Excel::import(new MigrateFire, $path);
    }
}
