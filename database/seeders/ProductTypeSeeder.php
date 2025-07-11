<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Enums\ProductType::cases() as $enum) {
            \App\Models\ProductType::updateOrCreate(
                ['id' => $enum->value],
                [
                    'id' => $enum->value,
                    'name' => $enum->name,
                ],
            );
        }
    }
}
