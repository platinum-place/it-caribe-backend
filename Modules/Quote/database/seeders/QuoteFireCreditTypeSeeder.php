<?php

namespace Modules\Quote\Database\Seeders;

use App\Models\QuoteFireCreditType;
use Illuminate\Database\Seeder;
use Modules\Quote\Enums\QuoteFireCreditTypeEnum;

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
