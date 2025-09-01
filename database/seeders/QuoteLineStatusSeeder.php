<?php

namespace Database\Seeders;

use App\Enums\QuoteLineStatusEnum;
use App\Models\QuoteLineStatus;
use Illuminate\Database\Seeder;

class QuoteLineStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (QuoteLineStatusEnum::cases() as $enum) {
            QuoteLineStatus::create([
                'id' => $enum->value,
                'name' => $enum->name,
            ]);
        }
    }
}
