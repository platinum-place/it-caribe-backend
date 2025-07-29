<?php

namespace Database\Seeders;

use App\Models\QuoteUnemploymentType;
use Illuminate\Database\Seeder;

class QuoteUnemploymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => \App\Enums\QuoteUnemploymentType::ONETIME_PAYMENT->value,
                'name' => 'Único Pago',
            ],
            [
                'id' => \App\Enums\QuoteUnemploymentType::MONTHLY->value,
                'name' => 'Mensual',
            ],
        ];

        foreach ($data as $item) {
            QuoteUnemploymentType::create($item);
        }
    }
}
