<?php

namespace Database\Seeders;

use App\Models\folder\QuoteUnemploymentDebtorType;
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
                'id' => \App\forlder\QuoteUnemploymentDebtorType::ONETIME_PAYMENT->value,
                'name' => 'Único Pago',
            ],
            [
                'id' => \App\forlder\QuoteUnemploymentDebtorType::MONTHLY->value,
                'name' => 'Mensual',
            ],
        ];

        foreach ($data as $item) {
            QuoteUnemploymentDebtorType::create($item);
        }
    }
}
