<?php

namespace Database\Seeders\Quotes;

use Illuminate\Database\Seeder;

class QuoteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Enums\Quotes\QuoteType::cases() as $enum) {
            \App\Models\Quotes\QuoteType::updateOrCreate(
                ['id' => $enum->value],
                [
                    'id' => $enum->value,
                    'name' => $enum->name,
                ],
            );
        }
    }
}
