<?php

namespace Modules\Infrastructure\Quotations\Products\Fire\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Domain\Quotations\Products\Fire\Enums\QuoteFireConstructionTypeEnum;
use Modules\Infrastructure\Quotations\Products\Fire\Persistence\Models\QuoteFireConstructionType;

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
