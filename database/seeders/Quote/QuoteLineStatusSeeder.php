<?php

namespace Database\Seeders\Quote;

use App\Enums\Quote\QuoteLineStatusEnum;
use App\Models\Quote\QuoteLineStatus;
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
