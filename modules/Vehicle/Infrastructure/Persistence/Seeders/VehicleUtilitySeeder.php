<?php

namespace Modules\Vehicle\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleUtility;

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
        ];

        foreach ($data as $item) {
            VehicleUtility::create($item);
        }
    }
}
