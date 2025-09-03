<?php

namespace Modules\Infrastructure\Quotations\Products\Fire\Persistence\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            QuoteFireConstructionTypeSeeder::class,
            QuoteFireCreditTypeSeeder::class,
            QuoteFireRiskTypeSeeder::class,
        ]);
    }
}
