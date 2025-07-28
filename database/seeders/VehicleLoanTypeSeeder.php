<?php

namespace Database\Seeders;

use App\Models\VehicleLoanType;
use App\Models\VehicleUse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
