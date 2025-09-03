<?php

namespace Modules\Infrastructure\Quotations\Core\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Domain\Quotations\Core\Enums\QuoteStatusEnum;
use Modules\Infrastructure\Quotations\Core\Persistence\Models\QuoteStatus;

class QuoteStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => QuoteStatusEnum::PENDING->value,
                'name' => 'Pendiente',
            ],
            [
                'id' => QuoteStatusEnum::APPROVED->value,
                'name' => 'Aprobado',
            ],
            [
                'id' => QuoteStatusEnum::REJECTED->value,
                'name' => 'Rechazado',
            ],
            [
                'id' => QuoteStatusEnum::CANCELLED->value,
                'name' => 'Cancelado',
            ],
            [
                'id' => QuoteStatusEnum::EXPIRED->value,
                'name' => 'Expirado',
            ],
            [
                'id' => QuoteStatusEnum::CHECKED->value,
                'name' => 'Verificado',
            ],
        ];

        foreach ($data as $item) {
            QuoteStatus::create($item);
        }
    }
}
