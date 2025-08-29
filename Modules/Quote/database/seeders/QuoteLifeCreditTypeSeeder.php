<?php

namespace Modules\Quote\Database\Seeders;

use App\Models\QuoteLifeCreditType;
use Illuminate\Database\Seeder;
use Modules\Quote\Enums\QuoteLifeCreditTypeEnum;

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
