<?php

namespace Database\Seeders;

use App\Models\QuoteStatus;
use Illuminate\Database\Seeder;

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
