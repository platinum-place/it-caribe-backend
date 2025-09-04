<?php

namespace Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleActivity;

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
