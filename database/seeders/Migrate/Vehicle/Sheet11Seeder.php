<?php

namespace Database\Seeders\Migrate\Vehicle;

use App\Enums\LeadTypeEnum;
use App\Enums\QuoteLineStatusEnum;
use App\Enums\QuoteStatusEnum;
use App\Enums\QuoteTypeEnum;
use App\Models\Branch;
use App\Models\Lead;
use App\Models\Quote;
use App\Models\QuoteLine;
use App\Models\QuoteVehicle;
use App\Models\QuoteVehicleLine;
use App\Models\Vehicle;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class Sheet11Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $path = base_path('migrate/Consolidado Polizas de Vehiculos Julio 2025.xlsx');

            $collection = (new FastExcel)->sheet(11)->import($path);

            $branch = Branch::firstOrCreate(
                ['name' => 'Principal'],
                ['name' => 'Principal'],
            );

            $collection->each(function ($line) use ($branch) {
                $lead = Lead::create([
                    'full_name' => $line['Nombre Cliente'],
                    'identity_number' => $line['Cliente ID'],
                    'age' => $line['Edad'] === 'No aplica' ? null : $line['Edad'],
                    'birth_date' => $line['Fecha de nacimiento'] === 'No aplica' ? null : $line['Fecha de nacimiento'],
                    'lead_type_id' => LeadTypeEnum::PUBLIC->value,
                ]);

                $quote = Quote::create([
                    'quote_type_id' => QuoteTypeEnum::VEHICLE->value,
                    'quote_status_id' => QuoteStatusEnum::APPROVED->value,
                    'lead_id' => $lead->id,
                    'start_date' => $line['Fecha Emision'],
                    'end_date' => $line['Fin de vigencia'],
                    'branch_id' => $branch->id,
                ]);

                $quoteLine = QuoteLine::create([
                    'name' => $line['Nombre aseguradora'],
                    'description' => $line['Plan'],
                    'quote_id' => $quote->id,
                    'quantity' => 1,
                    'total' => (float) $line['Prima Total'],
                    'quote_line_status_id' => QuoteLineStatusEnum::ACCEPTED->value,
                ]);

                $make = VehicleMake::where('name', 'ILIKE', '%'.$line['Marca'].'%')->first();

                if (! $make) {
                    $make = VehicleMake::create([
                        'name' => $line['Marca'],
                    ]);
                }

                $model = VehicleModel::where('name', 'ILIKE', '%'.$line['Modelo'].'%')->first();

                if (! $model) {
                    $model = VehicleModel::create([
                        'name' => $line['Modelo'],
                        'vehicle_make_id' => $make->id,
                        'vehicle_type_id' => 1,
                    ]);
                }

                $vehicle = Vehicle::create([
                    'vehicle_year' => $line['Año'],
                    'chassis' => $line['Chasis'],
                    'vehicle_make_id' => $make->id,
                    'vehicle_model_id' => $model->id,
                    'vehicle_type_id' => $model->vehicle_type_id,
                ]);

                $quoteVehicle = QuoteVehicle::create([
                    'quote_id' => $quote->id,
                    'vehicle_amount' => (float) $line['Valor Asegurado'],
                    'vehicle_id' => $vehicle->id,
                    'branch_id' => $branch->id,

                ]);

                $quoteVehicleLine = QuoteVehicleLine::create([
                    'quote_vehicle_id' => $quoteVehicle->id,
                    'quote_line_id' => $quoteLine->id,
                    'total_monthly' => (float) $line['Cuota Mensual'],
                    'amount_without_life_amount' => (float) $line['Cuota sin vida'],
                ]);
            });
        });
    }
}
