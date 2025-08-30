<?php

namespace Modules\Quote\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Quote\Models\QuoteStatus;

class QuoteStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\Modules\Quote\Enums\QuoteStatusEnum::cases() as $enum) {
            QuoteStatus::create([
                'id' => $enum->value,
                'name' => $enum->name,
            ]);
        }
    }
}
