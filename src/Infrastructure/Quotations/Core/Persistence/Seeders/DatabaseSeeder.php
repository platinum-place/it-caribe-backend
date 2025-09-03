<?php

namespace Modules\Infrastructure\Quotations\Core\Persistence\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Infrastructure\CRM\Persistence\Seeders\LeadTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            QuoteLineStatusSeeder::class,
            QuoteStatusSeeder::class,
            QuoteTypeSeeder::class,
        ]);
    }
}
