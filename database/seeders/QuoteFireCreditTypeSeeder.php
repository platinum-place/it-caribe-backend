<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\QuoteFireCreditTypeEnum;
use App\Models\QuoteFireCreditType;

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
