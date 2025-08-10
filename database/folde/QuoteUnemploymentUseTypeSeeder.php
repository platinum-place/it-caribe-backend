<?php

namespace Database\Seeders;

use App\Models\QuoteUnemploymentUseType;
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
                'id' => \App\Enums\QuoteUnemploymentUseType::PUBLIC->value,
                'name' => 'Público',
            ],
            [
                'id' => \App\Enums\QuoteUnemploymentUseType::PRIVATE->value,
                'name' => 'Privado',
            ],
        ];

        foreach ($data as $item) {
            QuoteUnemploymentUseType::create($item);
        }
    }
}
