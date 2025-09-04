<?php

namespace Modules\Infrastructure\Quotations\Products\Fire\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Domain\Quotations\Products\Fire\Enums\QuoteFireCreditTypeEnum;
use Modules\Infrastructure\Quotations\Products\Fire\Persistence\Models\QuoteFireCreditType;

class QuoteFireCreditTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => QuoteFireCreditTypeEnum::MORTGAGE->value,
                'name' => 'Préstamo Hipotecario',
            ],
            [
                'id' => QuoteFireCreditTypeEnum::PERSONAL->value,
                'name' => 'Préstamo de consumo personal (sin garantía)',
            ],
        ];

        foreach ($data as $item) {
            QuoteFireCreditType::create($item);
        }
    }
}
