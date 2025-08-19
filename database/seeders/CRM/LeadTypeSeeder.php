<?php

namespace Database\Seeders\CRM;

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
            LeadType::create($item);
        }
    }
}
