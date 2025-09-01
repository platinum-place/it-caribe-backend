<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\QuoteFireRiskTypeEnum;
use App\Models\QuoteFireRiskType;

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
