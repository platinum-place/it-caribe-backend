<?php

namespace Database\Seeders\Quote\Fire;

use App\Enums\Quote\Fire\QuoteFireConstructionTypeEnum;
use App\Models\Quote\Fire\QuoteFireConstructionType;
use Illuminate\Database\Seeder;

class QuoteFireConstructionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => QuoteFireConstructionTypeEnum::SUPERIOR->value,
                'name' => 'Superior',
            ],
        ];

        foreach ($data as $item) {
            QuoteFireConstructionType::create($item);
        }
    }
}
