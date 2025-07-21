<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuoteStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Enums\QuoteStatus::cases() as $enum) {
            \App\Models\QuoteStatus::updateOrCreate(
                ['id' => $enum->value],
                [
                    'id' => $enum->value,
                    'name' => $enum->name,
                ],
            );
        }
    }
}
