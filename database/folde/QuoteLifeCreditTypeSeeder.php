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
                'name' => 'Préstamo Personal',
            ],
            [
                'name' => 'Préstamo Comercial',
            ],
        ];

        foreach ($data as $item) {
            QuoteLifeCreditType::create($item);
        }
    }
}
