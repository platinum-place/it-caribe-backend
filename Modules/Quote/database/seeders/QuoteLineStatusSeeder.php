<?php

namespace Modules\Quote\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Quote\Enums\QuoteLineStatusEnum;
use Modules\Quote\Models\QuoteLineStatus;

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
