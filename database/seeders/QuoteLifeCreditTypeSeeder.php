<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\QuoteLifeCreditTypeEnum;
use App\Models\QuoteLifeCreditType;

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
