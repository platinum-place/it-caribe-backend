<?php

namespace Database\Seeders\Quote;

use App\Models\Quote\QuoteType;
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
                'id' => \App\Enums\Quote\QuoteTypeEnum::FIRE->value,
                'name' => 'Plan Seguro Incendio y Vida Hipotecario',
                'created_by' => 1,
            ],
            [
                'id' => \App\Enums\Quote\QuoteTypeEnum::LIFE->value,
                'name' => 'Plan Vida/Consumo',
                'created_by' => 1,
            ],
            [
                'id' => \App\Enums\Quote\QuoteTypeEnum::UNEMPLOYMENT->value,
                'name' => 'Plan Desempleo',
                'created_by' => 1,
            ],
            [
                'id' => \App\Enums\Quote\QuoteTypeEnum::VEHICLE->value,
                'name' => 'Plan Auto',
                'created_by' => 1,
            ],
            [
                'id' => \App\Enums\Quote\QuoteTypeEnum::DEBT_UNEMPLOYMENT->value,
                'name' => 'Plan Auto Ley',
                'created_by' => 1,
            ],
            [
                'id' => \App\Enums\Quote\QuoteTypeEnum::VEHICLE_LAW->value,
                'name' => 'Plan Desempleo Deuda',
                'created_by' => 1,
            ],
        ];

        foreach ($data as $item) {
            QuoteType::create($item);
        }
    }
}
