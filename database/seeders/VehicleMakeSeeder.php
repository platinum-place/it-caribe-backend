<?php

namespace Database\Seeders;

use App\Models\VehicleMake;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VehicleMakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $path = base_path('csvs/vehicle_makes.csv');
            $csv = File::get($path);
            $lines = explode(PHP_EOL, $csv);
            $headers = str_getcsv(array_shift($lines));

            foreach ($lines as $line) {
                $row = str_getcsv($line);

                if (empty($row[4])) {
                    continue;
                }

                VehicleMake::create([
                    'id' => $row[0],
                    'name' => $row[4],
                    'code' => $row[5],
                ]);
            }
        });

    }
}
