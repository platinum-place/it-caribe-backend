<?php

namespace Modules\Vehicle\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleUse;

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
