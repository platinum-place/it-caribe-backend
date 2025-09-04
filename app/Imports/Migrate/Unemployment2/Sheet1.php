<?php

namespace App\Imports\Migrate\Unemployment2;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Modules\Domain\CRM\Enums\LeadTypeEnum;
use Modules\Domain\Quotations\Core\Enums\QuoteLineStatusEnum;
use Modules\Domain\Quotations\Core\Enums\QuoteStatusEnum;
use Modules\Domain\Quotations\Core\Enums\QuoteTypeEnum;
use Modules\Domain\Quotations\Products\Unemployment\Enums\QuoteUnemploymentEmploymentTypeEnum;
use Modules\Domain\Quotations\Products\Unemployment\Enums\QuoteUnemploymentPaymentTypeEnum;
use Modules\Infrastructure\CRM\Persistence\Models\Lead;
use Modules\Infrastructure\Organization\Locations\Persistence\Models\Branch;
use Modules\Infrastructure\Quotations\Core\Persistence\Models\Quote;
use Modules\Infrastructure\Quotations\Core\Persistence\Models\QuoteLine;
use Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Models\QuoteUnemployment;
use Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Models\QuoteUnemploymentLine;

class Sheet1 implements ToCollection, WithChunkReading
{
    public function collection(Collection $collection)
    {
        DB::transaction(function () use ($collection) {
            foreach ($collection as $row) {
                if ($row->get(0) === 'NO.') {
                    continue;
                }

                if (empty($row->get(1))) {
                    break;
                }

                $branch = Branch::firstOrCreate(
                    ['name' => $row->get(1)],
                    ['name' => $row->get(1)],
                );

                $borrower = Lead::create([
                    'full_name' => $row->get(4),
                    'identity_number' => $row->get(3),
                    'birth_date' => date('Y-m-d', strtotime($row->get(18))),
                    'lead_type_id' => match ($row->get(11)) {
                        'Independiente' => LeadTypeEnum::SELF_EMPLOYED->value,
                        'Privado' => LeadTypeEnum::PRIVATE->value,
                        'Publico' => LeadTypeEnum::PUBLIC->value,
                    },
                ]);

                $quote = Quote::create([
                    'quote_type_id' => QuoteTypeEnum::UNEMPLOYMENT->value,
                    'quote_status_id' => QuoteStatusEnum::APPROVED->value,
                    'lead_id' => $borrower->id,
                    'start_date' => date('Y-m-d', strtotime($row->get(8))),
                    'end_date' => date('Y-m-d', strtotime($row->get(9))),
                    'branch_id' => $branch->id,
                ]);

                $quoteLine = QuoteLine::create([
                    'name' => 'Sura',
                    'quote_id' => $quote->id,
                    'quantity' => 1,
                    'quote_line_status_id' => QuoteLineStatusEnum::ACCEPTED->value,
                    'total' => $row->get(10),
                ]);

                $quoteUnemployment = QuoteUnemployment::create([
                    'quote_id' => $quote->id,
                    'branch_id' => $branch->id,
                    'quote_unemployment_employment_type_id' => QuoteUnemploymentEmploymentTypeEnum::PUBLIC->value,
                    'quote_unemployment_payment_type_id' => QuoteUnemploymentPaymentTypeEnum::MONTHLY->value,
                    'deadline_month' => $row->get(16),
                    'loan_installment' => $row->get(6),
                    'insured_amount' => $row->get(5),
                ]);

                $quoteUnemploymentLine = QuoteUnemploymentLine::create([
                    'quote_unemployment_id' => $quoteUnemployment->id,
                    'quote_line_id' => $quoteLine->id,
                ]);
            }
        });
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
