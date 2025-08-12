<?php

namespace Modules\CRM\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\CRM\Infrastructure\Persistence\Models\DebtorType;

class DebtorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Publico',
                'created_by' => 1,
            ],
            [
                'name' => 'Privado',
                'created_by' => 1,
            ],
            [
                'name' => 'Independiente',
                'created_by' => 1,
            ],
        ];

        foreach ($data as $item) {
            DebtorType::create($item);
        }
    }
}
