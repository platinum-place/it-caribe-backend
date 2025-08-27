<?php

namespace Database\Seeders\Quote\Fire;

use App\Enums\Quote\Fire\QuoteFireCreditTypeEnum;
use App\Models\Quote\Fire\QuoteFireCreditType;
use Illuminate\Database\Seeder;

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
