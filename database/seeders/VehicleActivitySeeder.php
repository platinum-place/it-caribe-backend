<?php

namespace Database\Seeders;

use App\Models\VehicleActivity;
use Illuminate\Database\Seeder;

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
