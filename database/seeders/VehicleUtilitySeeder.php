<?php

namespace Database\Seeders;

use App\Models\VehicleUtility;
use Illuminate\Database\Seeder;

class VehicleUtilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Japonés',
            ],
            [
                'name' => '0 KM',
            ],
            [
                'name' => 'Híbrido/Eléctrico',
            ],
            [
                'name' => 'Clásico',
            ],
            [
                'name' => 'Coreano',
            ],
        ];

        foreach ($data as $item) {
            VehicleUtility::create($item);
        }
    }
}
