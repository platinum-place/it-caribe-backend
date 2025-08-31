<?php

namespace Root\Vehicles\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Root\Vehicles\Infrastructure\Persistence\Models\VehicleActivity;

class VehicleActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Taxi',
            ],
            [
                'name' => 'Uber',
            ],
        ];

        foreach ($data as $item) {
            VehicleActivity::create($item);
        }
    }
}
