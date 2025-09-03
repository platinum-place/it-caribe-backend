<?php

namespace App\Imports\Migrate\Fire;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Modules\Domain\CRM\Enums\LeadTypeEnum;
use Modules\Domain\Quotations\Core\Enums\QuoteLineStatusEnum;
use Modules\Domain\Quotations\Core\Enums\QuoteStatusEnum;
use Modules\Domain\Quotations\Core\Enums\QuoteTypeEnum;
use Modules\Domain\Quotations\Products\Fire\Enums\QuoteFireConstructionTypeEnum;
use Modules\Domain\Quotations\Products\Fire\Enums\QuoteFireCreditTypeEnum;
use Modules\Domain\Quotations\Products\Fire\Enums\QuoteFireRiskTypeEnum;
use Modules\Infrastructure\CRM\Persistence\Models\Lead;
use Modules\Infrastructure\Organization\Locations\Persistence\Models\Branch;
use Modules\Infrastructure\Quotations\Core\Persistence\Models\Quote;
use Modules\Infrastructure\Quotations\Core\Persistence\Models\QuoteLine;
use Modules\Infrastructure\Quotations\Products\Fire\Persistence\Models\QuoteFire;
use Modules\Infrastructure\Quotations\Products\Fire\Persistence\Models\QuoteFireLine;

class Sheet2 implements ToCollection, WithCalculatedFormulas, WithChunkReading
{
    public function collection(Collection $collection)
    {
        DB::transaction(function () use ($collection) {
            $branch = Branch::findOrFail(1);

            foreach ($collection as $row) {
                if ($row->get(0) === 'No.') {
                    continue;
                }

                if (empty($row->get(5))) {
                    break;
                }

                $borrower = Lead::create([
                    'full_name' => $row->get(5),
                    'identity_number' => $row->get(4),
                    'lead_type_id' => LeadTypeEnum::PUBLIC->value,
                ]);

                $quote = Quote::create([
                    'quote_type_id' => QuoteTypeEnum::FIRE->value,
                    'quote_status_id' => QuoteStatusEnum::APPROVED->value,
                    'lead_id' => $borrower->id,
                    'start_date' => date('Y-m-d', strtotime($row->get(1))),
                    'end_date' => date('Y-m-d', strtotime($row->get(2))),
                    'branch_id' => $branch->id,
                ]);

                $quoteLine = QuoteLine::create([
                    'name' => 'Reservas',
                    'description' => $row->get(8),
                    'total' => $row->get(13),
                    'quote_id' => $quote->id,
                    'quantity' => 1,
                    'quote_line_status_id' => QuoteLineStatusEnum::ACCEPTED->value,
                ]);

                $quoteFire = QuoteFire::create([
                    'quote_id' => $quote->id,
                    'quote_fire_credit_type_id' => QuoteFireCreditTypeEnum::PERSONAL->value,
                    'quote_fire_risk_type_id' => QuoteFireRiskTypeEnum::COMMERCIAL->value,
                    'quote_fire_construction_type_id' => QuoteFireConstructionTypeEnum::SUPERIOR->value,
                    'appraisal_value' => $row->get(12),
                    'property_address' => $row->get(7),
                    'branch_id' => $branch->id,

                ]);

                $quoteFireLine = QuoteFireLine::create([
                    'quote_fire_id' => $quoteFire->id,
                    'quote_line_id' => $quoteLine->id,
                    'fire_rate' => empty($row->get(11)) ? 0 : $row->get(11),
                ]);
            }
        });
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
