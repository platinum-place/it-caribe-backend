<?php

namespace Modules\Quote\Database\Seeders;

use App\Models\QuoteUnemploymentPaymentType;
use Illuminate\Database\Seeder;
use Modules\Quote\Enums\QuoteUnemploymentPaymentTypeEnum;

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
