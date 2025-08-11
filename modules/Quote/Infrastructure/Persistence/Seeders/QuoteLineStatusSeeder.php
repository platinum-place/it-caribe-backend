<?php

namespace Modules\Quote\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Seeder;

class QuoteLineStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\Modules\Quote\Domain\Enums\QuoteLineStatusEnum::cases() as $enum) {
            \Modules\Quote\Infrastructure\Persistance\Models\QuoteLineStatus::updateOrCreate(
                ['id' => $enum->value],
                [
                    'id' => $enum->value,
                    'name' => $enum->name,
                ],
            );
        }
    }
}
