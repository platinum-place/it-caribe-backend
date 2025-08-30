<?php

namespace Modules\Quote\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Quote\Enums\QuoteFireConstructionTypeEnum;
use Modules\Quote\Models\QuoteFireConstructionType;

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
