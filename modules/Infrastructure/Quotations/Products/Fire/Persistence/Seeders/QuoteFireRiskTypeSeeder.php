<?php

namespace Modules\Infrastructure\Quotations\Products\Fire\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Domain\Quotations\Products\Fire\Enums\QuoteFireRiskTypeEnum;
use Modules\Infrastructure\Quotations\Products\Fire\Persistence\Models\QuoteFireRiskType;

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
