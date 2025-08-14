<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quote_unemployments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignIdFor(\Modules\Quote\Infrastructure\Persistance\Models\Quote::class)->constrained();
            $table->foreignIdFor(\App\Models\folder\QuoteUnemploymentDebtorType::class)->constrained();
            $table->foreignIdFor(\App\Models\folder\QuoteUnemploymentUseType::class)->constrained();
            $table->integer('deadline')->default(0);
            $table->decimal('loan_installment', 18, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_unemployments');
    }
};
