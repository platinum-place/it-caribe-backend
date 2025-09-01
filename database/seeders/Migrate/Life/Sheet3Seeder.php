<?php

namespace Database\Seeders\Migrate\Life;

use App\Enums\LeadTypeEnum;
use App\Enums\QuoteLifeCreditTypeEnum;
use App\Enums\QuoteLineStatusEnum;
use App\Enums\QuoteStatusEnum;
use App\Enums\QuoteTypeEnum;
use App\Models\Branch;
use App\Models\Lead;
use App\Models\Quote;
use App\Models\QuoteLife;
use App\Models\QuoteLifeLine;
use App\Models\QuoteLine;
use DateTimeImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class Sheet3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $path = base_path('migrate/Consolidado Vida Consumo Julio 2025.xlsx');

        $collection = (new FastExcel)->sheet(3)->import($path);

        $collection->chunk(1000)->each(function ($chunk) {
            DB::transaction(function () use ($chunk) {
                foreach ($chunk as $line) {
                    if (empty($line['Sucursal'])) {
                        continue;
                    }

                    $branch = Branch::firstOrCreate(
                        ['name' => $line['Sucursal']],
                        ['name' => $line['Sucursal']],
                    );

                    $borrower = Lead::create([
                        'full_name' => $line['Nombre Cliente'],
                        'identity_number' => $line['Identificación Cliente'],
                        'age' => round($line['Edad'], 0),
                        'birth_date' => $line['FECHA DE NACIMIENTO'] instanceof DateTimeImmutable ? $line['FECHA DE NACIMIENTO'] : null,
                        'lead_type_id' => LeadTypeEnum::PUBLIC->value,
                    ]);

                    if (!empty($line['Identificación Co'])) {
                        $coBorrower = Lead::create([
                            'full_name' => $line['Codeudor'],
                            'identity_number' => $line['Identificación Co'],
                            'age' => $line['Edad Co'],
                            'lead_type_id' => LeadTypeEnum::PUBLIC->value,
                        ]);
                    }

                    $quote = Quote::create([
                        'quote_type_id' => QuoteTypeEnum::VEHICLE->value,
                        'quote_status_id' => QuoteStatusEnum::APPROVED->value,
                        'lead_id' => $borrower->id,
                        'start_date' => $line['Fecha_Emi'],
                        'end_date' => $line['Fecha_Venc'],
                        'branch_id' => $branch->id,
                    ]);

                    $quoteLine = QuoteLine::create([
                        'name' => 'Mapfre',
                        'description' => $line['Descripción Producto'],
                        'quote_id' => $quote->id,
                        'quantity' => 1,
                        'total' => (float)$line['MONTO A PAGAR'],
                        'quote_line_status_id' => QuoteLineStatusEnum::ACCEPTED->value,
                    ]);

                    $quoteLife = QuoteLife::create([
                        'quote_id' => $quote->id,
                        'co_borrower_id' => $coBorrower?->id ?? null,
                        'quote_life_credit_type_id' => QuoteLifeCreditTypeEnum::PERSONAL_LOAN->value,
                        'deadline_month' => (int)$line['Plazo'],
                        'insured_amount' => (float)$line['Monto Orig.'],
                    ]);

                    $quoteLifeLine = QuoteLifeLine::create([
                        'quote_life_id' => $quoteLife->id,
                        'quote_line_id' => $quoteLine->id,
                        'borrower_rate' => (int)$line['Tasa'],
                    ]);
                }
            });
        });
    }
}
