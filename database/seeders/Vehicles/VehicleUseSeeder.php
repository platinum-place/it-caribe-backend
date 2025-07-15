<?php

namespace Database\Seeders\Vehicles;

use App\Models\Vehicles\VehicleAccessory;
use App\Models\Vehicles\VehicleUse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        ];

        foreach ($data as $item) {
            VehicleUse::create($item);
        }
    }
}
