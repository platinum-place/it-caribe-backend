<?php

namespace Modules\Quote\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Quote\Domain\Enums\QuoteLineStatusEnum;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteLineStatus;

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
                'created_by' => 1,
            ]);
        }
    }
}
