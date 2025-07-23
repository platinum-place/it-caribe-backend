<?php

namespace Database\Seeders;

use App\Models\QuoteCreditType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuoteCreditTypeSeeder extends Seeder
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
            QuoteCreditType::create($item);
        }
    }
}
