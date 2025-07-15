<?php

namespace Database\Seeders\Quotes;

use Database\Seeders\AdminUserSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            QuoteTypeSeeder::class,
            QuoteStatusSeeder::class,
        ]);
    }
}
