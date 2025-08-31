<?php

namespace Root\CRM\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Root\CRM\Domain\Enums\LeadTypeEnum;
use Root\CRM\Infrastructure\Persistence\Models\LeadType;

class LeadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => LeadTypeEnum::PUBLIC->value,
                'name' => 'Publico',
            ],
            [
                'id' => LeadTypeEnum::PRIVATE->value,
                'name' => 'Privado',
            ],
            [
                'id' => LeadTypeEnum::SELF_EMPLOYED->value,
                'name' => 'Independiente',
            ],
        ];

        foreach ($data as $item) {
            LeadType::create($item);
        }
    }
}
