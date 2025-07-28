<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuoteTypeNewNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => \App\Enums\QuoteType::FIRE->value,
                'name' => 'Plan Seguro Incendio y Vida Hipotecario',
            ],
            [
                'id' => \App\Enums\QuoteType::LIFE->value,
                'name' => 'Plan Vida/Consumo',
            ],
            [
                'id' => \App\Enums\QuoteType::UNEMPLOYMENT->value,
                'name' => 'Plan Desempleo',
            ],
            [
                'id' => \App\Enums\QuoteType::VEHICLE->value,
                'name' => 'Plan Auto',
            ],
            [
                'id' => \App\Enums\QuoteType::DEBT_UNEMPLOYMENT->value,
                'name' => 'Plan Auto Ley',
            ],
            [
                'id' => \App\Enums\QuoteType::VEHICLE_LAW->value,
                'name' => 'Plan Desempleo Deuda',
            ],
        ];

        foreach ($data as $item) {
            \App\Models\QuoteType::findOrFail($item['id'])->update($item);
        }
    }
}
