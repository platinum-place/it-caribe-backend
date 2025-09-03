<?php

namespace Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Domain\Quotations\Products\Unemployment\Enums\QuoteUnemploymentEmploymentTypeEnum;
use Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Models\QuoteUnemploymentEmploymentType;

class QuoteUnemploymentEmploymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => QuoteUnemploymentEmploymentTypeEnum::PUBLIC->value,
                'name' => 'Público',
            ],
            [
                'id' => QuoteUnemploymentEmploymentTypeEnum::PRIVATE->value,
                'name' => 'Privado',
            ],
        ];

        foreach ($data as $item) {
            QuoteUnemploymentEmploymentType::create($item);
        }
    }
}
