<?php

namespace Database\Seeders;

use App\Models\QuoteFireRiskType;
use Illuminate\Database\Seeder;

class QuoteFireRiskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => \App\Enums\QuoteFireRiskType::HOUSING->value,
                'name' => 'Vivienda',
            ],
            [
                'id' => \App\Enums\QuoteFireRiskType::COMMERCIAL->value,
                'name' => 'Riesgo comercial',
            ],
        ];

        foreach ($data as $item) {
            QuoteFireRiskType::create($item);
        }
    }
}
