<?php

namespace Database\Seeders;

use App\Models\QuoteFireCreditType;
use App\Models\QuoteLifeCreditType;
use Illuminate\Database\Seeder;

class QuoteFireCreditTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Préstamo de consumo personal (sin garantía)',
            ],
        ];

        foreach ($data as $item) {
            QuoteFireCreditType::create($item);
        }
    }
}
