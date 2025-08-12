<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleAccessory;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleActivity;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleColor;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleLoanType;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleMake;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleModel;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleType;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleUse;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleUtility;

class SimpleCSVSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $modelMappings = [
                'users' => User::class,
                'vehicle_accessories' => VehicleAccessory::class,
                'vehicle_activities' => VehicleActivity::class,
                'vehicle_colors' => VehicleColor::class,
                'vehicle_loan_types' => VehicleLoanType::class,
                'vehicle_types' => VehicleType::class,
                'vehicle_utilities' => VehicleUtility::class,
                'vehicle_makes' => VehicleMake::class,
                'vehicle_models' => VehicleModel::class,
                'vehicle_uses' => VehicleUse::class,
            ];

            echo "Importando desde CSV...\n";

            foreach ($modelMappings as $table => $modelClass) {
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

                    try {
                        $modelClass::create($rowData);
                    } catch (\Exception $e) {
                        // Si el registro ya existe, lo ignoramos
                        if (strpos($e->getMessage(), 'duplicate key') !== false) {
                            continue;
                        }
                        // Si es otro error, lo mostramos pero continuamos
                        echo "⚠️ Error en {$table}: {$e->getMessage()}\n";
                    }
                }

                fclose($handle);

                $count = $modelClass::count();
                echo "✅ {$table}: {$count} registros\n";

                // Resetear secuencia después de importar cada tabla
                $this->resetSequence($table);
            }

            echo "🎉 Importación completada!\n";
        });

    }

    /**
     * Resetea la secuencia de una tabla para que continue desde el último ID
     */
    private function resetSequence(string $tableName): void
    {
        try {
            // Obtener el nombre de la secuencia (generalmente tabla_id_seq)
            $sequenceName = "{$tableName}_id_seq";

            // Obtener el máximo ID actual de la tabla
            $maxId = DB::table($tableName)->max('id') ?? 0;

            // Resetear la secuencia al siguiente valor después del máximo ID
            DB::statement("SELECT setval('{$sequenceName}', {$maxId}, true)");

            echo "🔧 Secuencia {$sequenceName} reseteada al valor ".($maxId + 1)."\n";
        } catch (\Exception $e) {
            // Si hay error con la secuencia, lo reportamos pero continuamos
            echo "⚠️ No se pudo resetear la secuencia para {$tableName}: {$e->getMessage()}\n";
        }
    }
}
