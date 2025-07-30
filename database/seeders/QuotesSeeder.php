<?php

namespace Database\Seeders;

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
            QuoteLineStatusSeeder::class,
            QuoteLifeCreditTypeSeeder::class,
            QuoteFireRiskTypeSeeder::class,
            QuoteFireConstructionTypeSeeder::class,
            QuoteTypeNewNamesSeeder::class,
            QuoteFireCreditTypeSeeder::class,
            QuoteUnemploymentDebtorTypeSeeder::class,
            QuoteUnemploymentUseTypeSeeder::class,
        ]);
    }
}
