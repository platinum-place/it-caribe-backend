<?php

namespace Database\Seeders;

use App\Enums\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Enums\ProductType::cases() as $type) {
            \App\Models\ProductType::updateOrCreate(
                ['id' => $type->value],
                ['id' => $type->value],
            );
        }
    }
}
