<?php

namespace Database\Seeders;

use App\Models\VehicleUse;
use Illuminate\Database\Seeder;

class VehicleUseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Publico',
            ],
            [
                'name' => 'Privado',
            ],
            [
                'name' => 'Comercial',
            ],
            [
                'name' => 'Préstamo  de consumo con garantía de vehículo ',
            ],
            [
                'name' => 'Préstamo de vehículo',
            ],
        ];

        foreach ($data as $item) {
            VehicleUse::create($item);
        }
    }
}
