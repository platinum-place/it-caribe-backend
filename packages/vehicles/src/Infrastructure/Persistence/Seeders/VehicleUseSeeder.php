<?php

namespace Root\Vehicles\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Root\Vehicles\Infrastructure\Persistence\Models\VehicleUse;

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
