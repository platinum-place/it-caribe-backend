<?php

namespace Database\Seeders;

use App\Enums\Quote\QuoteLineStatusEnum;
use App\Enums\Quote\QuoteStatusEnum;
use App\Enums\Quote\QuoteTypeEnum;
use App\Models\CRM\Lead;
use App\Models\Quote\Quote;
use App\Models\Quote\QuoteLine;
use App\Models\Quote\Vehicle\QuoteVehicle;
use App\Models\Quote\Vehicle\QuoteVehicleLine;
use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Models\Vehicle\VehicleUtility;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrateSeeder extends Seeder
{
    /**
     * Convierte fecha usando Carbon
     */
    private function parseDate(?string $date): ?string
    {
        if (!$date || trim($date) === '') {
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
        if ($value === null) return null;

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
        if (!$enc) {
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

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Cambiar datestyle temporalmente para PostgreSQL
            DB::statement("SET datestyle = 'DMY'");
            $rows = [];

            // Leer el archivo CSV
            $csvFile = base_path('csvs/VEHICULOS 1.csv');

            if (file_exists($csvFile)) {
                $handle = fopen($csvFile, 'r');

                // Probar diferentes delimitadores
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

                if (!$headers) {
                    echo "❌ No se pudieron leer los headers correctamente\n";
                    fclose($handle);
                    return;
                }

                echo "✅ Headers encontrados con delimitador '{$delimiter}': " . implode(', ', $headers) . "\n";
                echo "📊 Total de columnas: " . count($headers) . "\n";

                while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
                    // Validar que el número de columnas coincida con los headers
                    if (count($headers) !== count($row)) {
                        echo "⚠️ Saltando fila con número de columnas diferente: " . count($row) . " columnas vs " . count($headers) . " headers\n";
                        continue;
                    }

                    $rowData = array_combine($headers, $row);

                    // Limpiar datos vacíos y convertir valores a UTF-8 limpio (NO cambiamos keys/headers)
                    foreach ($rowData as $key => $value) {
                        // Mantener NULL explícito
                        if ($value === '' || strtoupper($value) === 'NULL') {
                            $rowData[$key] = null;
                            continue;
                        }

                        // Convertir/limpiar el valor a UTF-8
                        $rowData[$key] = $this->to_utf8_clean($value);
                    }

                    $rows[] = $rowData;
                }

                fclose($handle);
            }

            foreach ($rows as $row) {
                $lead = Lead::create([
                    'full_name' => $row['NOMBE '] ?? null,
                    //            'first_name',
                    //            'last_name',
                    'identity_number' => $row['IDENTIFICACION'] ?? null,
//                    'age',
                    'birth_date' => $this->parseDate($row['FECHA DE NACIMIENTO'] ?? null),
                    //            'home_phone',
                    //            'mobile_phone',
                    //            'work_phone',
                    //            'email',
                    //            'address',
                    //            'debtor_type_id',
                    'created_by' => 1,
                ]);
                $make = VehicleMake::whereRaw('LOWER(name) = ?', [strtolower($row['MARCA'] ?? null)])->firstOrFail();

                $model = VehicleModel::whereRaw('LOWER(name) = ?', [strtolower($row['MODELO'] ?? null)])
                    ->orWhere('name', 'ILIKE', $row['MODELO'] ?? null)
                    ->first();

                if (!$model) {
                    $model = VehicleModel::create([
                        'name' => $row['MODELO'],
                        'vehicle_make_id' => $make->id,
                        'vehicle_type_id' => 1,
                        'created_by' => 1,
                    ]);
                }
                switch ($row['PLAN']) {
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
                    //            'attachments',
                    'start_date' => $this->parseDate($row['FECHA  '] ?? null),
                    'end_date' => $this->parseDate($row['VENCIMIENTO'] ?? null),
                    'responsible_id' => 1,
                    'created_by' => 1,
                ]);

                $quoteVehicle = QuoteVehicle::create([
                    'quote_id' => $quote->id,
                    'vehicle_amount' => (float)$row[' VALOR ASEGURADO '] ?? null,
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
                    'unit_price' => (float)$row[' PRIMA TOTAL '] ?? null,
                    'quantity' => 1,
                    'subtotal' => (float)$row[' PRIMA TOTAL '] ?? null,
                    //                'tax_rate',
                    'total' => (float)$row[' PRIMA TOTAL '] ?? null,
                    'amount_taxed' => (float)$row[' PRIMA TOTAL '] ?? null,
                    'quote_line_status_id' => QuoteLineStatusEnum::ACCEPTED->value,
                    'created_by' => 1,
                ]);

                $quoteVehicleLine = QuoteVehicleLine::create([
                    'quote_vehicle_id' => $quoteVehicle->id,
                    'quote_line_id' => $quoteLine->id,
                    'life_amount' => 120,
                    'latest_expenses' => 20,
                    'markup' => 80,
                    'total_monthly' => (float)$row[' CUOTA MENSUAL '] ?? null,
                    //                'vehicle_rate',
                    'amount_without_life_amount' => (float)$row[' PRIMA SIN VIDA '] ?? null,
                    'created_by' => 1,
                ]);
            }
        });
    }
}
