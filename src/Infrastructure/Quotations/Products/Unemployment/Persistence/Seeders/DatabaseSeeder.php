<?php

namespace Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Seeders;

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
            QuoteUnemploymentEmploymentTypeSeeder::class,
            QuoteUnemploymentPaymentTypeSeeder::class,
        ]);
    }
}
