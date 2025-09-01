<?php

namespace Database\Seeders;

use App\Enums\QuoteFireConstructionTypeEnum;
use App\Models\QuoteFireConstructionType;
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
