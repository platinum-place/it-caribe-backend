<?php

namespace Modules\Quote\Database\Seeders;

use App\Models\QuoteStatus;
use Illuminate\Database\Seeder;

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
