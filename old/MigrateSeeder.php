<?php

namespace old;

use App\Models\Quote;
use App\Models\QuoteLine;
use App\Models\QuoteVehicle;
use App\Models\QuoteVehicleLine;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\CRM\Models\Lead;
use Modules\Quote\Enums\QuoteLineStatusEnum;
use Modules\Quote\Enums\QuoteStatusEnum;
use Modules\Quote\Enums\QuoteTypeEnum;
use Modules\Vehicle\Models\Vehicle;
use Modules\Vehicle\Models\VehicleMake;
use Modules\Vehicle\Models\VehicleModel;
use Modules\Vehicle\Models\VehicleUtility;

class MigrateSeeder extends Seeder
{
    /**
     * Convierte fecha usando Carbon
     */
    private function parseDate(?string $date): ?string
    {
        if (! $date || trim($date) === '') {
            return null;
        }

        try {
            return Carbon::createFromFormat('d/m/Y', trim($date))->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Limpia y convierte un valor a UTF-8 seguro
     */
    private function to_utf8_clean(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        // Quitar BOM si está en el valor (no tocamos headers)
        $value = preg_replace('/^\xEF\xBB\xBF/', '', $value);

        // Si ya es UTF-8 válido, solo eliminamos caracteres de control invisibles y retornamos
        if (mb_check_encoding($value, 'UTF-8')) {
            // eliminar caracteres de control (excepto tab, LF, CR)
            $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/u', '', $value);

            return trim($value);
        }

        // Intentar detectar encoding; si falla, asumir Windows-1252
        $enc = mb_detect_encoding($value, ['UTF-8', 'Windows-1252', 'ISO-8859-1', 'ISO-8859-15', 'ASCII'], true);
        if (! $enc) {
            $enc = 'Windows-1252';
        }

        // Intentar convertir con iconv
        $converted = @iconv($enc, 'UTF-8//TRANSLIT//IGNORE', $value);

        // fallback a mb_convert_encoding si iconv falla
        if ($converted === false) {
            $converted = @mb_convert_encoding($value, 'UTF-8', $enc);
        }

        if ($converted === false || $converted === null) {
            // Si todo falla, eliminar bytes no ASCII como último recurso
            $converted = preg_replace('/[^\x20-\x7E\s]/', '', $value);
        }

        // Eliminar caracteres de control que hayan quedado
        $converted = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/u', '', $converted);

        return trim($converted);
    }

    private function cleanNumeric(?string $value): ?float
    {
        if ($value === null) {
            return null;
        }
        // Elimina comas de miles y espacios
        $clean = str_replace([',', ' '], '', $value);
        // Si está vacío después de limpiar, retorna null
        if ($clean === '' || strtoupper($clean) === 'NULL') {
            return null;
        }

        return (float) $clean;
    }

    private function parseCSV()
    {
        $rows = [];

        $csvFiles = [
            base_path('csvs/VEHICULOS 1.csv'),
            base_path('csvs/VEHICULOS 2.csv'),
            base_path('csvs/VEHICULOS 3.csv'),
            base_path('csvs/VEHICULOS 4.csv'),
            base_path('csvs/VEHICULOS 5.csv'),
            base_path('csvs/VEHICULOS 6.csv'),
            base_path('csvs/VEHICULOS 7.csv'),
            base_path('csvs/VEHICULOS 8.csv'),
            base_path('csvs/VEHICULOS 9.csv'),
            base_path('csvs/VEHICULOS 10.csv'),
            base_path('csvs/VEHICULOS 11.csv'),
            base_path('csvs/VEHICULOS 12.csv'),
        ];

        foreach ($csvFiles as $csvFile) {
            if (file_exists($csvFile)) {
                $handle = fopen($csvFile, 'r');

                $delimiters = [',', ';', "\t"];
                $headers = null;
                $delimiter = ',';

                foreach ($delimiters as $testDelimiter) {
                    rewind($handle);
                    $testHeaders = fgetcsv($handle, 0, $testDelimiter);
                    if ($testHeaders && count($testHeaders) > 1) {
                        $headers = $testHeaders;
                        $delimiter = $testDelimiter;
                        break;
                    }
                }

                if (! $headers) {
                    echo "❌ No se pudieron leer los headers correctamente en {$csvFile}\n";
                    fclose($handle);

                    continue;
                }

                while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
                    if (count($headers) !== count($row)) {
                        echo '⚠️ Saltando fila con número de columnas diferente: '.count($row).' columnas vs '.count($headers)." headers\n";

                        continue;
                    }

                    $rowData = array_combine($headers, $row);

                    foreach ($rowData as $key => $value) {
                        if ($value === '' || strtoupper($value) === 'NULL') {
                            $rowData[$key] = null;

                            continue;
                        }

                        $rowData[$key] = $this->to_utf8_clean($value);
                    }

                    $rows[] = $rowData;
                }

                fclose($handle);
            }
        }

        echo '📊 Total: '.count($rows)."\n";

        return $rows;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            DB::statement("SET datestyle = 'DMY'");

            $rows = $this->parseCSV();

            $totalInsertados = 0;

            foreach ($rows as $row) {
                if (empty($row['IDENTIFICACION'])) {
                    echo print_r($row);

                    continue;
                }
                $lead = Lead::create([
                    'full_name' => $row['NOMBE '] ?? $row['NOMBRE '] ?? null,
                    //            'first_name',
                    //            'last_name',
                    'identity_number' => $row['IDENTIFICACION'] ?? null,
                    'age' => isset($row['EDAD']) && is_int($row['EDAD']) ? $row['EDAD'] : null,
                    'birth_date' => $this->parseDate($row['FECHA DE NACIMIENTO'] ?? null),
                    //            'home_phone',
                    //            'mobile_phone',
                    //            'work_phone',
                    //            'email',
                    //            'address',
                    //            'debtor_type_id',
                    'created_by' => 1,
                ]);
                $make = VehicleMake::whereRaw('LOWER(name) = ?', [strtolower($row['MARCA'] ?? null)])
                    ->orWhere('name', 'ILIKE', $row['MARCA'] ?? null)
                    ->first();

                if (! $make) {
                    $make = VehicleMake::create([
                        'name' => $row['MODELO'],
                        'created_by' => 1,
                    ]);
                }

                $model = VehicleModel::whereRaw('LOWER(name) = ?', [strtolower($row['MODELO'] ?? null)])
                    ->orWhere('name', 'ILIKE', $row['MODELO'] ?? null)
                    ->first();

                if (! $model) {
                    $model = VehicleModel::create([
                        'name' => $row['MODELO'],
                        'vehicle_make_id' => $make->id,
                        'vehicle_type_id' => 1,
                        'created_by' => 1,
                    ]);
                }
                switch ($row['PLAN'] ?? null) {
                    case '0KM':
                        $utility = '0 KM';
                        break;

                    case 'Econo':
                        $utility = 'Japonés';
                        break;

                    case 'Hibrido / El‚ctrico' || 'Electricos':
                        $utility = 'Híbrido/Eléctrico';
                        break;

                    default:
                        $utility = 'Clásico';
                        break;
                }

                $vehicle = Vehicle::create([
                    'created_by' => 1,
                    'chassis' => $row['CHASIS'] ?? null,
                    'license_plate' => 'TRAMITE',
                    'vehicle_make_id' => $make->id,
                    'vehicle_year' => $row['ANO'] ?? null,
                    'vehicle_model_id' => $model->id,
                    'vehicle_type_id' => $model->vehicle_type_id,
                    'vehicle_utility_id' => VehicleUtility::firstWhere('name', $utility)->id,
                    //            'vehicle_use_id',
                    //            'vehicle_activity_id',
                    //            'vehicle_loan_type_id',
                ]);

                $quote = Quote::create([
                    'quote_type_id' => QuoteTypeEnum::VEHICLE->value,
                    'quote_status_id' => QuoteStatusEnum::APPROVED->value,
                    'lead_id' => $lead->id,
                    'branch_id' => 1,
                    //            'attachments',
                    'start_date' => $this->parseDate($row['FECHA  '] ?? null),
                    'end_date' => $this->parseDate($row['VENCIMIENTO'] ?? null),
                    'created_by' => 1,
                ]);

                $quoteVehicle = QuoteVehicle::create([
                    'quote_id' => $quote->id,
                    'vehicle_amount' => $this->cleanNumeric($row[' VALOR ASEGURADO '] ?? 0),
                    'vehicle_id' => $vehicle->id,
                    //            'is_employee',
                    //            'leasing',
                    //            'vehicle_loan_amount',
                    'created_by' => 1,
                ]);

                $quoteLine = QuoteLine::create([
                    'name' => $row['ASEGURADORA'] ?? null,
                    //                'description',
                    'quote_id' => $quote->id,
                    'unit_price' => $this->cleanNumeric($row['PRIMA CON IMPUESTO'] ?? 0),
                    'quantity' => 1,
                    'subtotal' => $this->cleanNumeric($row['PRIMA CON IMPUESTO'] ?? 0),
                    'tax_rate' => 16,
                    'tax_amount' => $this->cleanNumeric($row['IMPUESTO'] ?? 0),
                    'total' => $this->cleanNumeric($row[' PRIMA TOTAL '] ?? 0),
                    'amount_taxed' => $this->cleanNumeric($row['PRIMA SIN IMPUESTO'] ?? 0),
                    'quote_line_status_id' => QuoteLineStatusEnum::ACCEPTED->value,
                    'created_by' => 1,
                ]);

                $quoteVehicleLine = QuoteVehicleLine::create([
                    'quote_vehicle_id' => $quoteVehicle->id,
                    'quote_line_id' => $quoteLine->id,
                    'life_amount' => 120,
                    'latest_expenses' => 20,
                    'markup' => 80,
                    'total_monthly' => $this->cleanNumeric($row[' CUOTA MENSUAL '] ?? 0),
                    //                'vehicle_rate',
                    'amount_without_life_amount' => $this->cleanNumeric($row[' PRIMA SIN VIDA '] ?? 0),
                    'created_by' => 1,
                ]);

                $totalInsertados++;
            }

            echo "✅ Inserciones totales: {$totalInsertados}\n";
        });
    }
}
