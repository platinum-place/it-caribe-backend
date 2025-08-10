<?php

namespace Database\Seeders;

use App\Models\QuoteUnemploymentDebtorType;
use Illuminate\Database\Seeder;

class QuoteUnemploymentDebtorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => \App\Enums\QuoteUnemploymentDebtorType::ONETIME_PAYMENT->value,
                'name' => 'Único Pago',
            ],
            [
                'id' => \App\Enums\QuoteUnemploymentDebtorType::MONTHLY->value,
                'name' => 'Mensual',
            ],
        ];

        foreach ($data as $item) {
            QuoteUnemploymentDebtorType::create($item);
        }
    }
}
