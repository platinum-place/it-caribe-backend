<?php

namespace Modules\Quote\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteType;

class QuoteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => \Modules\Quote\Domain\Enums\QuoteTypeEnum::FIRE->value,
                'name' => 'Plan Seguro Incendio y Vida Hipotecario',
                'created_by' => 1,
            ],
            [
                'id' => \Modules\Quote\Domain\Enums\QuoteTypeEnum::LIFE->value,
                'name' => 'Plan Vida/Consumo',
                'created_by' => 1,
            ],
            [
                'id' => \Modules\Quote\Domain\Enums\QuoteTypeEnum::UNEMPLOYMENT->value,
                'name' => 'Plan Desempleo',
                'created_by' => 1,
            ],
            [
                'id' => \Modules\Quote\Domain\Enums\QuoteTypeEnum::VEHICLE->value,
                'name' => 'Plan Auto',
                'created_by' => 1,
            ],
            [
                'id' => \Modules\Quote\Domain\Enums\QuoteTypeEnum::DEBT_UNEMPLOYMENT->value,
                'name' => 'Plan Auto Ley',
                'created_by' => 1,
            ],
            [
                'id' => \Modules\Quote\Domain\Enums\QuoteTypeEnum::VEHICLE_LAW->value,
                'name' => 'Plan Desempleo Deuda',
                'created_by' => 1,
            ],
        ];

        foreach ($data as $item) {
            QuoteType::create($item);
        }
    }
}
