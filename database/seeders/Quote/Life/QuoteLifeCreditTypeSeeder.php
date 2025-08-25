<?php

namespace Database\Seeders\Quote\Life;

use App\Enums\Quote\Life\QuoteLifeCreditTypeEnum;
use App\Models\Quote\Life\QuoteLifeCreditType;
use Illuminate\Database\Seeder;

class QuoteLifeCreditTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => QuoteLifeCreditTypeEnum::PERSONAL_LOAN->value,
                'name' => 'Préstamo Personal',
            ],
            [
                'id' => QuoteLifeCreditTypeEnum::BUSINESS_LOAN->value,
                'name' => 'Préstamo Comercial',
            ],
        ];

        foreach ($data as $item) {
            QuoteLifeCreditType::create($item);
        }
    }
}
