<?php

namespace Modules\Infrastructure\Catalogs\Vehicles\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleUse;

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
