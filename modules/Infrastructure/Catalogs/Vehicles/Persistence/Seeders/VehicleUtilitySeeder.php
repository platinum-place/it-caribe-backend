<?php

namespace Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleUtility;

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
