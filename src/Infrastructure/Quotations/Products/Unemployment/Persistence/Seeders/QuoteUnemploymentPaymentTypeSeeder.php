<?php

namespace Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Domain\Quotations\Products\Unemployment\Enums\QuoteUnemploymentPaymentTypeEnum;
use Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Models\QuoteUnemploymentPaymentType;

class QuoteUnemploymentPaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => QuoteUnemploymentPaymentTypeEnum::ONETIME_PAYMENT->value,
                'name' => 'Único Pago',
            ],
            [
                'id' => QuoteUnemploymentPaymentTypeEnum::MONTHLY->value,
                'name' => 'Mensual',
            ],
        ];

        foreach ($data as $item) {
            QuoteUnemploymentPaymentType::create($item);
        }
    }
}
