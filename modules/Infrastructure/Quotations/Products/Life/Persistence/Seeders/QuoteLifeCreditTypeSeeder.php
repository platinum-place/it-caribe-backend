<?php

namespace Modules\Infrastructure\Quotations\Products\Life\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Domain\Quotations\Products\Life\Enums\QuoteLifeCreditTypeEnum;
use Modules\Infrastructure\Quotations\Products\Life\Persistence\Models\QuoteLifeCreditType;

class QuoteLifeCreditTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => QuoteLifeCreditTypeEnum::PERSONAL_LOAN->value,
                'name' => 'Préstamo Personal',
            ],
            [
                'id' => QuoteLifeCreditTypeEnum::BUSINESS_LOAN->value,
                'name' => 'Préstamo Comercial',
            ],
        ];

        foreach ($data as $item) {
            QuoteLifeCreditType::create($item);
        }
    }
}
