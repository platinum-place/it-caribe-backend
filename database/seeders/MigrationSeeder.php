<?php

namespace Database\Seeders;

use App\Enums\LeadTypeEnum;
use App\Enums\QuoteLineStatusEnum;
use App\Enums\QuoteStatusEnum;
use App\Enums\QuoteTypeEnum;
use App\Models\Branch;
use App\Models\Lead;
use App\Models\Quote;
use App\Models\QuoteLine;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class MigrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $path = base_path('migrate/Consolidado Polizas de Vehiculos Julio 2025.xlsx');

            $collection = (new FastExcel)->sheet(1)->import($path);

            $branch = Branch::create([
                'name' => 'Principal',
            ]);

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

                $vehicle = Vehicle::create([
                    'vehicle_year',
                    'chassis',
                    'license_plate',
                    'vehicle_make_id',
                    'vehicle_model_id',
                    'vehicle_type_id',
                    'vehicle_use_id',
                    'vehicle_activity_id',
                    'vehicle_loan_type_id',
                    'vehicle_utility_id',
                ]);
            });

            dd($collection->get(1));
        });
    }
}
