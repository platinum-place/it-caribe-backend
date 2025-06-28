<?php

namespace Database\Seeders;

use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Models\Vehicle\VehicleType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedVehicleTypes();
        $this->seedVehicleMakes();
        $this->seedVehicleModels();
    }

    /**
     * Seed the vehicle types from tipos.csv
     */
    private function seedVehicleTypes(): void
    {
        // Disable foreign key checks during seeding
        DB::statement('SET CONSTRAINTS ALL DEFERRED');
        VehicleType::truncate();
        DB::statement('SET CONSTRAINTS ALL IMMEDIATE');

        $csvFile = database_path('seeders/tipos.csv');
        $this->processCsv($csvFile, function ($data) {
            VehicleType::create([
                'id' => $data[0],
                'name' => $this->cleanString($data[1]),
            ]);
        });

        $this->command->info('Vehicle types seeded successfully!');
    }

    /**
     * Seed the vehicle makes from marcas.csv
     */
    private function seedVehicleMakes(): void
    {
        // Disable foreign key checks during seeding
        DB::statement('SET CONSTRAINTS ALL DEFERRED');
        VehicleMake::truncate();
        DB::statement('SET CONSTRAINTS ALL IMMEDIATE');

        $csvFile = database_path('seeders/marcas.csv');
        $this->processCsv($csvFile, function ($data) {
            VehicleMake::create([
                'id' => $data[0],
                'name' => $this->cleanString($data[2]),
            ]);
        });

        $this->command->info('Vehicle makes seeded successfully!');
    }

    /**
     * Seed the vehicle models from modelos.csv
     */
    private function seedVehicleModels(): void
    {
        // Disable foreign key checks during seeding
        DB::statement('SET CONSTRAINTS ALL DEFERRED');
        VehicleModel::truncate();
        DB::statement('SET CONSTRAINTS ALL IMMEDIATE');

        $csvFile = database_path('seeders/modelos.csv');
        $this->processCsv($csvFile, function ($data) {
            try {
                VehicleModel::create([
                    'id' => $data[0],
                    'vehicle_make_id' => $this->findMakeId($data[1]),
                    'name' => $this->cleanString($data[5]),
                    'vehicle_type_id' => $this->findTypeId($data[3]),
                ]);
            } catch (\Exception $e) {
                Log::error('Error importing model ID: '.$data[0].' - '.$e->getMessage());
            }
        });

        $this->command->info('Vehicle models seeded successfully!');
    }

    /**
     * Process a CSV file line by line
     */
    private function processCsv(string $file, callable $callback): void
    {
        if (! file_exists($file)) {
            $this->command->error("CSV file not found: {$file}");

            return;
        }

        $handle = fopen($file, 'r');

        // Skip the header row
        fgetcsv($handle, 0, ';');

        while (($data = fgetcsv($handle, 0, ';')) !== false) {
            if (count($data) > 0) {
                $callback($data);
            }
        }

        fclose($handle);
    }

    /**
     * Clean string from CSV file (handle encoding issues)
     */
    private function cleanString(string $string): string
    {
        $string = trim($string);
        // Fix encoding issues with special characters
        $string = mb_convert_encoding($string, 'UTF-8', 'ISO-8859-1');

        return $string;
    }

    /**
     * Find make ID by name
     */
    private function findMakeId(string $makeName): int
    {
        $make = VehicleMake::where('name', $this->cleanString($makeName))->first();
        if (! $make) {
            // If not found, create it
            $make = VehicleMake::create([
                'name' => $this->cleanString($makeName),
                'crm_name' => strtoupper($this->cleanString($makeName)),
            ]);
        }

        return $make->id;
    }

    /**
     * Find type ID by name
     */
    private function findTypeId(string $typeName): int
    {
        $type = VehicleType::where('name', $this->cleanString($typeName))->first();
        if (! $type) {
            // If not found, create it
            $type = VehicleType::create([
                'name' => $this->cleanString($typeName),
            ]);
        }

        return $type->id;
    }
}
