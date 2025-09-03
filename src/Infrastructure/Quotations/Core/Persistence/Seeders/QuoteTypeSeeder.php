<?php

namespace Modules\Infrastructure\Quotations\Core\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Domain\Quotations\Core\Enums\QuoteTypeEnum;
use Modules\Infrastructure\Quotations\Core\Persistence\Models\QuoteType;

class QuoteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => QuoteTypeEnum::FIRE->value,
                'name' => 'Plan Seguro Incendio y Vida Hipotecario',
            ],
            [
                'id' => QuoteTypeEnum::LIFE->value,
                'name' => 'Plan Vida/Consumo',
            ],
            [
                'id' => QuoteTypeEnum::UNEMPLOYMENT->value,
                'name' => 'Plan Desempleo',
            ],
            [
                'id' => QuoteTypeEnum::VEHICLE->value,
                'name' => 'Plan Auto',
            ],
            [
                'id' => QuoteTypeEnum::DEBT_UNEMPLOYMENT->value,
                'name' => 'Plan Auto Ley',
            ],
            [
                'id' => QuoteTypeEnum::VEHICLE_LAW->value,
                'name' => 'Plan Desempleo Deuda',
            ],
        ];

        foreach ($data as $item) {
            QuoteType::create($item);
        }
    }
}
