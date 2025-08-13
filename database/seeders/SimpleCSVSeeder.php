<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SimpleCSVSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // Lista de tablas a importar desde CSV (solo nombres de tabla)
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
                'vehicle_uses',
                'oauth_clients',
                'oauth_auth_codes',
                'oauth_device_codes',
                'oauth_access_tokens',
                'oauth_refresh_tokens',
                'personal_access_tokens',
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

                // Obtener las columnas de la tabla para validar
                $tableColumns = collect(DB::select("SELECT column_name FROM information_schema.columns WHERE table_name = ?", [$table]))
                    ->pluck('column_name')
                    ->toArray();

                $insertedCount = 0;
                while (($row = fgetcsv($handle)) !== false) {
                    $rowData = array_combine($headers, $row);

                    // Limpiar datos
                    foreach ($rowData as $key => $value) {
                        if ($value === '' || $value === 'NULL') {
                            $rowData[$key] = null;
                        }
                    }

                    // Agregar created_by = 1 si no existe, la tabla no es users, y la tabla tiene la columna created_by
                    if (! array_key_exists('created_by', $rowData) &&
                        $table !== 'users' &&
                        in_array('created_by', $tableColumns)) {
                        $rowData['created_by'] = 1;
                    }

                    // Filtrar solo las columnas que existen en la tabla
                    $filteredRowData = array_filter($rowData, function($key) use ($tableColumns) {
                        return in_array($key, $tableColumns);
                    }, ARRAY_FILTER_USE_KEY);

                    try {
                        DB::table($table)->insert($filteredRowData);
                        $insertedCount++;
                    } catch (\Exception $e) {
                        // Si el registro ya existe, lo ignoramos
                        if (strpos($e->getMessage(), 'duplicate key') !== false || strpos($e->getMessage(), 'UNIQUE constraint') !== false) {
                            continue;
                        }
                        // Si es otro error, lo mostramos pero continuamos
                        echo "⚠️ Error en {$table}: {$e->getMessage()}\n";
                    }
                }

                fclose($handle);

                $count = DB::table($table)->count();
                echo "✅ {$table}: {$count} registros totales ({$insertedCount} nuevos insertados)\n";

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
            // Verificar si la tabla tiene columna 'id'
            $hasIdColumn = collect(DB::select("SELECT column_name FROM information_schema.columns WHERE table_name = ? AND column_name = 'id'", [$tableName]))->isNotEmpty();

            if (!$hasIdColumn) {
                echo "ℹ️ Tabla {$tableName} no tiene columna 'id', omitiendo reseteo de secuencia\n";
                return;
            }

            // Obtener el nombre de la secuencia (generalmente tabla_id_seq)
            $sequenceName = "{$tableName}_id_seq";

            // Verificar si la secuencia existe
            $sequenceExists = collect(DB::select("SELECT 1 FROM pg_class WHERE relkind = 'S' AND relname = ?", [$sequenceName]))->isNotEmpty();

            if (!$sequenceExists) {
                echo "ℹ️ Secuencia {$sequenceName} no existe, omitiendo reseteo\n";
                return;
            }

            // Obtener el máximo ID actual de la tabla
            $maxId = DB::table($tableName)->max('id') ?? 0;

            // Resetear la secuencia al siguiente valor después del máximo ID
            if ($maxId > 0) {
                DB::statement("SELECT setval('{$sequenceName}', {$maxId}, true)");
                echo "🔧 Secuencia {$sequenceName} reseteada al valor ".($maxId + 1)."\n";
            } else {
                DB::statement("SELECT setval('{$sequenceName}', 1, false)");
                echo "🔧 Secuencia {$sequenceName} reseteada al valor 1\n";
            }

        } catch (\Exception $e) {
            // Si hay error con la secuencia, lo reportamos pero continuamos
            echo "⚠️ No se pudo resetear la secuencia para {$tableName}: {$e->getMessage()}\n";
        }
    }
}
