<?php

namespace Modules\Quote\Database\Seeders;

use App\Models\QuoteFireRiskType;
use Illuminate\Database\Seeder;
use Modules\Quote\Enums\QuoteFireRiskTypeEnum;

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
