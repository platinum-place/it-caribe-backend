<?php

namespace Database\Seeders\Migrate\Vehicle;

use App\Enums\QuoteLineStatusEnum;
use App\Enums\QuoteStatusEnum;
use App\Enums\QuoteTypeEnum;
use App\Models\Quote;
use App\Models\QuoteLine;
use App\Models\QuoteVehicle;
use App\Models\QuoteVehicleLine;
use App\Models\Vehicle;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Domain\CRM\Enums\LeadTypeEnum;
use Modules\Infrastructure\CRM\Persistence\Models\Lead;
use Modules\Infrastructure\Organization\Locations\Persistence\Models\Branch;
use Rap2hpoutre\FastExcel\FastExcel;

class Sheet9Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $path = base_path('migrate/Consolidado Polizas de Vehiculos Julio 2025.xlsx');

            $collection = (new FastExcel)->sheet(9)->import($path);

            $branch = Branch::firstOrCreate(
                ['name' => 'Principal'],
                ['name' => 'Principal'],
            );

            $collection->each(function ($line) use ($branch) {
                $lead = Lead::create([
                    'full_name' => $line['NOMBE '],
                    'identity_number' => $line['IDENTIFICACION'],
                    'age' => $line['EDAD'] === 'No aplica' ? null : $line['EDAD'],
                    'birth_date' => $line['FECHA DE NACIMIENTO'] === 'No aplica' ? null : $line['FECHA DE NACIMIENTO'],
                    'lead_type_id' => LeadTypeEnum::PUBLIC->value,
                ]);

                $quote = Quote::create([
                    'quote_type_id' => QuoteTypeEnum::VEHICLE->value,
                    'quote_status_id' => QuoteStatusEnum::APPROVED->value,
                    'lead_id' => $lead->id,
                    'start_date' => $line['FECHA  '],
                    'end_date' => $line['VENCIMIENTO'],
                    'branch_id' => $branch->id,
                ]);

                $quoteLine = QuoteLine::create([
                    'name' => $line['ASEGURADORA'],
                    'description' => $line['PLAN'],
                    'quote_id' => $quote->id,
                    'quantity' => 1,
                    'total' => (float) $line['PRIMA TOTAL'],
                    'quote_line_status_id' => QuoteLineStatusEnum::ACCEPTED->value,
                ]);

                $make = VehicleMake::where('name', 'ILIKE', '%'.$line['MARCA'].'%')->first();

                if (! $make) {
                    $make = VehicleMake::create([
                        'name' => $line['MARCA'],
                    ]);
                }

                $model = VehicleModel::where('name', 'ILIKE', '%'.$line['MODELO'].'%')->first();

                if (! $model) {
                    $model = VehicleModel::create([
                        'name' => $line['MODELO'],
                        'vehicle_make_id' => $make->id,
                        'vehicle_type_id' => 1,
                    ]);
                }

                $vehicle = Vehicle::create([
                    'vehicle_year' => $line['AÑO'],
                    'chassis' => $line['CHASIS'],
                    'vehicle_make_id' => $make->id,
                    'vehicle_model_id' => $model->id,
                    'vehicle_type_id' => $model->vehicle_type_id,
                ]);

                $quoteVehicle = QuoteVehicle::create([
                    'quote_id' => $quote->id,
                    'vehicle_amount' => (float) $line['VALOR ASEGURADO'],
                    'vehicle_id' => $vehicle->id,
                    'branch_id' => $branch->id,

                ]);

                $quoteVehicleLine = QuoteVehicleLine::create([
                    'quote_vehicle_id' => $quoteVehicle->id,
                    'quote_line_id' => $quoteLine->id,
                    'total_monthly' => (float) $line['CUOTA MENSUAL'],
                    'amount_without_life_amount' => (float) $line['PRIMA SIN VIDA'],
                ]);
            });
        });
    }
}
