<?php

namespace Database\Seeders\CRM;

use App\Enums\CRM\LeadTypeEnum;
use App\Models\CRM\LeadType;
use Illuminate\Database\Seeder;

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
