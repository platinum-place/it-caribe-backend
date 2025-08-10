<?php

namespace Modules\CRM\Infrastructure\Persistance\Seeders;

use Illuminate\Database\Seeder;
use Modules\CRM\Infrastructure\Persistance\Models\DebtorType;

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
            ],
            [
                'name' => 'Privado',
            ],
            [
                'name' => 'Independiente',
            ],
        ];

        foreach ($data as $item) {
            DebtorType::create($item);
        }
    }
}
