<?php

namespace Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleLoanType;

class VehicleLoanTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Préstamo de consumo con garantía de vehículo',
            ],
            [
                'name' => 'Préstamo de vehículo',
            ],
        ];

        foreach ($data as $item) {
            VehicleLoanType::create($item);
        }
    }
}
