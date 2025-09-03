<?php

namespace App\Imports\Migrate\Fire;

use App\Enums\LeadTypeEnum;
use App\Enums\QuoteFireConstructionTypeEnum;
use App\Enums\QuoteFireCreditTypeEnum;
use App\Enums\QuoteFireRiskTypeEnum;
use App\Enums\QuoteLineStatusEnum;
use App\Enums\QuoteStatusEnum;
use App\Enums\QuoteTypeEnum;
use App\Models\Branch;
use App\Models\Lead;
use App\Models\Quote;
use App\Models\QuoteFire;
use App\Models\QuoteFireLine;
use App\Models\QuoteLine;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class Sheet3 implements ToCollection, WithCalculatedFormulas, WithChunkReading
{
    public function collection(Collection $collection)
    {
        DB::transaction(function () use ($collection) {
            $branch = Branch::findOrFail(1);

            foreach ($collection as $row) {
                if ($row->get(0) === 'NO.') {
                    continue;
                }

                if (empty($row->get(1))) {
                    break;
                }

                $borrower = Lead::create([
                    'full_name' => $row->get(1),
                    'identity_number' => $row->get(2),
                    'home_phone' => $row->get(3),
                    'email' => $row->get(4),
                    'lead_type_id' => LeadTypeEnum::PUBLIC->value,
                ]);

                $quote = Quote::create([
                    'quote_type_id' => QuoteTypeEnum::FIRE->value,
                    'quote_status_id' => QuoteStatusEnum::APPROVED->value,
                    'lead_id' => $borrower->id,
                    'start_date' => date('Y-m-d', strtotime($row->get(24))),
                    'end_date' => date('Y-m-d', strtotime($row->get(25))),
                    'branch_id' => $branch->id,
                ]);

                $quoteLine = QuoteLine::create([
                    'name' => 'Sura',
                    'description' => $row->get(7),
                    'quote_id' => $quote->id,
                    'quantity' => 1,
                    'amount_taxed' => $row->get(10),
                    'tax_amount' => $row->get(12),
                    'total' => $row->get(11),
                    'quote_line_status_id' => QuoteLineStatusEnum::ACCEPTED->value,
                ]);

                $quoteFire = QuoteFire::create([
                    'quote_id' => $quote->id,
                    'quote_fire_credit_type_id' => QuoteFireCreditTypeEnum::PERSONAL->value,
                    'quote_fire_risk_type_id' => QuoteFireRiskTypeEnum::COMMERCIAL->value,
                    'quote_fire_construction_type_id' => QuoteFireConstructionTypeEnum::SUPERIOR->value,
                    'appraisal_value' => $row->get(8),
                    'property_address' => $row->get(21),
                    'branch_id' => $branch->id,

                ]);

                $quoteFireLine = QuoteFireLine::create([
                    'quote_fire_id' => $quoteFire->id,
                    'quote_line_id' => $quoteLine->id,
                    'fire_rate' => empty($row->get(9)) ? 0 : $row->get(9),
                ]);
            }
        });
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
