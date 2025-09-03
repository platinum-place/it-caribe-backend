<?php

namespace Database\Seeders;

use App\Enums\QuoteStatusEnum;
use App\Models\QuoteStatus;
use Illuminate\Database\Seeder;

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
