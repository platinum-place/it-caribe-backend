<?php

namespace Database\Seeders;

use App\Models\QuoteFireCreditType;
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
//                'name' => 'Préstamo de consumo personal (sin garantía)',
                'name' => 'Préstamo Hipotecario',
            ],
        ];

        foreach ($data as $item) {
            QuoteFireCreditType::create($item);
        }
    }
}
