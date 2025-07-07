<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Enums\ProductCategory::cases() as $type) {
            \App\Models\ProductCategory::updateOrCreate(
                ['id' => $type->value],
                ['id' => $type->value],
            );
        }
    }
}
