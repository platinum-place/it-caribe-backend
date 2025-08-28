<?php

namespace Database\Seeders\Quote\Unemployment;

use App\Enums\Quote\Unemployment\QuoteUnemploymentEmploymentTypeEnum;
use App\Models\Quote\Unemployment\QuoteUnemploymentEmploymentType;
use Illuminate\Database\Seeder;

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
