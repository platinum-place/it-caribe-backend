<?php

namespace Database\Seeders;

use App\Models\folder\QuoteUnemploymentUseType;
use Illuminate\Database\Seeder;

class QuoteUnemploymentUseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => \App\forlder\QuoteUnemploymentUseType::PUBLIC->value,
                'name' => 'Público',
            ],
            [
                'id' => \App\forlder\QuoteUnemploymentUseType::PRIVATE->value,
                'name' => 'Privado',
            ],
        ];

        foreach ($data as $item) {
            QuoteUnemploymentUseType::create($item);
        }
    }
}
