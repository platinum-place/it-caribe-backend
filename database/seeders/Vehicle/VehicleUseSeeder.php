<?php

namespace Database\Seeders\Vehicle;

use App\Models\Vehicle\VehicleUse;
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
            [
                'name' => 'Comercial',
            ],
        ];

        foreach ($data as $item) {
            VehicleUse::create($item);
        }
    }
}
