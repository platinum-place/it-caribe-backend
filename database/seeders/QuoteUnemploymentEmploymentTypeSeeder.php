<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\QuoteUnemploymentEmploymentTypeEnum;
use App\Models\QuoteUnemploymentEmploymentType;

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
