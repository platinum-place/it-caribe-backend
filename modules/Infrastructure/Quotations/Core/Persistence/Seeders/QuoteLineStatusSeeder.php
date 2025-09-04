<?php

namespace Modules\Infrastructure\Quotations\Core\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Domain\Quotations\Core\Enums\QuoteLineStatusEnum;
use Modules\Infrastructure\Quotations\Core\Persistence\Models\QuoteLineStatus;

class QuoteLineStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => QuoteLineStatusEnum::NOT_ACCEPTED->value,
                'name' => 'No aceptado',
            ],
            [
                'id' => QuoteLineStatusEnum::ACCEPTED->value,
                'name' => 'Aceptado',
            ],
        ];

        foreach ($data as $item) {
            QuoteLineStatus::create($item);
        }
    }
}
