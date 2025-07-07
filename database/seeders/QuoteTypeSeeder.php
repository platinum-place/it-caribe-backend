<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuoteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Enums\QuoteType::cases() as $type) {
            \App\Models\QuoteType::updateOrCreate(
                ['id' => $type->value],
                ['id' => $type->value],
            );
        }
    }
}
