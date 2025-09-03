<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleModel;

class VehicleModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {

            $path = base_path('csvs/vehicle_models.csv');
            $csv = File::get($path);
            $lines = explode(PHP_EOL, $csv);
            $headers = str_getcsv(array_shift($lines));

            foreach ($lines as $line) {
                $row = str_getcsv($line);

                if (empty($row[4])) {
                    continue;
                }

                VehicleModel::create([
                    'id' => $row[0],
                    'name' => $row[4],
                    'vehicle_make_id' => $row[5],
                    'vehicle_type_id' => $row[6],
                    'code' => $row[7],
                ]);
            }

            $maxId = DB::table('vehicle_models')->max('id');
            DB::statement("SELECT setval('vehicle_models_id_seq', {$maxId})");
        });
    }
}
