<?php

namespace Database\Seeders;

use App\Models\VehicleColor;
use Illuminate\Database\Seeder;

class VehicleColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Rojo',
            ],
            [
                'name' => 'Amarillo',
            ],
            [
                'name' => 'Azul',
            ],
            [
                'name' => 'Azul Agua',
            ],
            [
                'name' => 'Azul Cielo',
            ],
        ];

        foreach ($data as $item) {
            VehicleColor::create($item);
        }
    }
}
