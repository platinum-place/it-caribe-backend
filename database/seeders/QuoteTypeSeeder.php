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
        foreach (\App\Enums\QuoteType::cases() as $enum) {
            \App\Models\QuoteType::updateOrCreate(
                ['id' => $enum->value],
                [
                    'id' => $enum->value,
                    'name' => $enum->name,
                ],
            );
        }
    }
}
