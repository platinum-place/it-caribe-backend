<?php

namespace Modules\Quote\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteStatus;

class QuoteStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\Modules\Quote\Domain\Enums\QuoteStatusEnum::cases() as $enum) {
            QuoteStatus::create([
                'id' => $enum->value,
                'name' => $enum->name,
                'created_by' => 1,
            ]);
        }
    }
}
