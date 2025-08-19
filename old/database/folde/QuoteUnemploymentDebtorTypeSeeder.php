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
                'id' => \app\Enums\forlder\QuoteUnemploymentDebtorType::ONETIME_PAYMENT->value,
                'name' => 'Único Pago',
            ],
            [
                'id' => \app\Enums\forlder\QuoteUnemploymentDebtorType::MONTHLY->value,
                'name' => 'Mensual',
            ],
        ];

        foreach ($data as $item) {
            QuoteUnemploymentDebtorType::create($item);
        }
    }
}
