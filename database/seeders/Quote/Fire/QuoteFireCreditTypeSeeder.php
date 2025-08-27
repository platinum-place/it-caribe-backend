<?php

namespace Database\Seeders\Quote\Fire;

use App\Models\Quote\Fire\QuoteFireCreditType;
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
                'name' => 'Préstamo Hipotecario',
            ],
            [
                'name' => 'Préstamo de consumo personal (sin garantía)',
            ],
        ];

        foreach ($data as $item) {
            QuoteFireCreditType::create($item);
        }
    }
}
