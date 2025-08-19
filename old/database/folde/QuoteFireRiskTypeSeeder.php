<?php

namespace Database\Seeders;

use App\Models\folder\QuoteFireRiskType;
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
                'id' => \app\Enums\forlder\QuoteFireRiskType::HOUSING->value,
                'name' => 'Vivienda',
            ],
            [
                'id' => \app\Enums\forlder\QuoteFireRiskType::COMMERCIAL->value,
                'name' => 'Riesgo comercial',
            ],
        ];

        foreach ($data as $item) {
            QuoteFireRiskType::create($item);
        }
    }
}
