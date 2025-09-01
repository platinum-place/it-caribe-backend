<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuoteStatus;

class QuoteStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Enums\QuoteStatusEnum::cases() as $enum) {
            QuoteStatus::create([
                'id' => $enum->value,
                'name' => $enum->name,
            ]);
        }
    }
}
