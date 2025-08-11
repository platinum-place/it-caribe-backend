<?php

namespace Modules\Quote\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Seeder;

class QuoteStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\Modules\Quote\Domain\Enums\QuoteStatusEnum::cases() as $enum) {
            \Modules\Quote\Infrastructure\Persistance\Models\QuoteStatus::updateOrCreate(
                ['id' => $enum->value],
                [
                    'id' => $enum->value,
                    'name' => $enum->name,
                ],
            );
        }
    }
}
