<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleUseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Enums\VehicleUse::cases() as $type) {
            \App\Models\VehicleUse::updateOrCreate(
                ['id' => $type->value],
                ['id' => $type->value],
            );
        }
    }
}
