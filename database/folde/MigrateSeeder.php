<?php

namespace Database\Seeders;

use App\Imports\MigrateImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class MigrateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = \Storage::path('VEHICULOS.xlsx');

        Excel::import(new MigrateImport, $path);
    }
}
