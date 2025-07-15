<?php

namespace Database\Seeders\Quotes;

use Illuminate\Database\Seeder;

class QuoteStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Enums\Quotes\QuoteStatus::cases() as $enum) {
            \App\Models\Quotes\QuoteStatus::updateOrCreate(
                ['id' => $enum->value],
                [
                    'id' => $enum->value,
                    'name' => $enum->name,
                ],
            );
        }
    }
}
