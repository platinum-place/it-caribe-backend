<?php

namespace Database\Seeders;

use App\Models\QuoteLifeCreditType;
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
                'name' => 'Línea de Crédito',
            ],
            [
                'name' => 'Préstamo Personal',
            ],
        ];

        foreach ($data as $item) {
            QuoteLifeCreditType::create($item);
        }
    }
}
