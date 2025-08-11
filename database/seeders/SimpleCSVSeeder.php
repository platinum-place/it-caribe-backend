<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SimpleCSVSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $tables = [
                'users',
                'vehicle_accessories',
                'vehicle_activities',
                'vehicle_colors',
                'vehicle_loan_types',
                'vehicle_types',
                'vehicle_utilities',
                'vehicle_makes',
                'vehicle_models',
                'vehicle_routes',
                'vehicle_uses',
            ];

            echo "Importando desde CSV...\n";

            foreach ($tables as $table) {
                $csvFile = base_path("csvs/{$table}.csv");

                if (! file_exists($csvFile)) {
                    echo "❌ {$table}.csv no encontrado\n";

                    continue;
                }

                echo "📥 Importando {$table}...\n";

                $handle = fopen($csvFile, 'r');
                $headers = fgetcsv($handle); // Primera línea = headers

                $data = [];
                while (($row = fgetcsv($handle)) !== false) {
                    $rowData = array_combine($headers, $row);

                    // Limpiar datos
                    foreach ($rowData as $key => $value) {
                        if ($value === '' || $value === 'NULL') {
                            $rowData[$key] = null;
                        }
                    }

                    // Agregar created_by = 1 si no existe
                    if (! array_key_exists('created_by', $rowData) && $table !== 'users') {
                        $rowData['created_by'] = 1;
                    }

                    $data[] = $rowData;

                    // Insertar en chunks de 500
                    if (count($data) >= 500) {
                        DB::table($table)->insert($data);
                        $data = [];
                    }
                }

                // Insertar último chunk
                if (! empty($data)) {
                    DB::table($table)->insert($data);
                }

                fclose($handle);

                $count = DB::table($table)->count();
                echo "✅ {$table}: {$count} registros\n";
            }

            echo "🎉 Importación completada!\n";
        });

    }
}
