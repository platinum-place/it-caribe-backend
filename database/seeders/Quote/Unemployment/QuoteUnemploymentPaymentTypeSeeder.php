<?php

namespace Database\Seeders\Quote\Unemployment;

use App\Enums\Quote\Unemployment\QuoteUnemploymentPaymentTypeEnum;
use App\Models\Quote\Unemployment\QuoteUnemploymentPaymentType;
use Illuminate\Database\Seeder;

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
