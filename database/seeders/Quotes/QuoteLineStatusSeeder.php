<?php

namespace Database\Seeders\Quotes;

use Illuminate\Database\Seeder;

class QuoteLineStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Enums\Quotes\QuoteLineStatus::cases() as $enum) {
            \App\Models\Quotes\QuoteLineStatus::updateOrCreate(
                ['id' => $enum->value],
                [
                    'id' => $enum->value,
                    'name' => $enum->name,
                ],
            );
        }
    }
}
