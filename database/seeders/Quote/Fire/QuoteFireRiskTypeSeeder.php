<?php

namespace Database\Seeders\Quote\Fire;

use App\Enums\Quote\Fire\QuoteFireRiskTypeEnum;
use App\Models\Quote\Fire\QuoteFireRiskType;
use Illuminate\Database\Seeder;

class QuoteFireRiskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => QuoteFireRiskTypeEnum::HOUSING->value,
                'name' => 'Vivienda',
            ],
            [
                'id' => QuoteFireRiskTypeEnum::COMMERCIAL->value,
                'name' => 'Riesgo comercial',
            ],
        ];

        foreach ($data as $item) {
            QuoteFireRiskType::create($item);
        }
    }
}
