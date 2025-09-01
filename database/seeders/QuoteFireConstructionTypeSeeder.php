<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\QuoteFireConstructionTypeEnum;
use App\Models\QuoteFireConstructionType;

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
