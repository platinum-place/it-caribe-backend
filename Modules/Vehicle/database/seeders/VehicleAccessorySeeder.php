<?php

namespace Modules\Vehicle\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Vehicle\Models\VehicleAccessory;

class VehicleAccessorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'OTROS EQUIPO DE GAS',
            ],
            [
                'name' => 'Cambio de Guia',
            ],
            [
                'name' => 'LOVATO',
            ],
            [
                'name' => 'ROMANO',
            ],
            [
                'name' => 'SISTEMA DE GAS NATURAL APROBADO',
            ],
        ];

        foreach ($data as $item) {
            VehicleAccessory::create($item);
        }
    }
}
