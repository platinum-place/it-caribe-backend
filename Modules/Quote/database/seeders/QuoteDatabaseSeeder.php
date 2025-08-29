<?php

namespace Modules\Quote\Database\Seeders;

use Illuminate\Database\Seeder;

class QuoteDatabaseSeeder extends Seeder
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
            QuoteFireConstructionTypeSeeder::class,
            QuoteFireCreditTypeSeeder::class,
            QuoteFireRiskTypeSeeder::class,
            QuoteUnemploymentPaymentTypeSeeder::class,
            QuoteUnemploymentEmploymentTypeSeeder::class,
        ]);
    }
}
