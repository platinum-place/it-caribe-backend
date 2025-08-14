<?php

namespace Database\Seeders\Vehicle;

use App\Models\Vehicle\VehicleLoanType;
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
