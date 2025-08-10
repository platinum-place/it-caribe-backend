<?php

namespace Modules\Quote\Infrastructure\Persistance\Seeders;

use Illuminate\Database\Seeder;

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
            ],
            [
                'id' => \Modules\Quote\Domain\Enums\QuoteTypeEnum::LIFE->value,
                'name' => 'Plan Vida/Consumo',
            ],
            [
                'id' => \Modules\Quote\Domain\Enums\QuoteTypeEnum::UNEMPLOYMENT->value,
                'name' => 'Plan Desempleo',
            ],
            [
                'id' => \Modules\Quote\Domain\Enums\QuoteTypeEnum::VEHICLE->value,
                'name' => 'Plan Auto',
            ],
            [
                'id' => \Modules\Quote\Domain\Enums\QuoteTypeEnum::DEBT_UNEMPLOYMENT->value,
                'name' => 'Plan Auto Ley',
            ],
            [
                'id' => \Modules\Quote\Domain\Enums\QuoteTypeEnum::VEHICLE_LAW->value,
                'name' => 'Plan Desempleo Deuda',
            ],
        ];

        foreach ($data as $item) {
            \Modules\Quote\Infrastructure\Persistance\Models\QuoteType::findOrFail($item['id'])->update($item);
        }
    }
}
