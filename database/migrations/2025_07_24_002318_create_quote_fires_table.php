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
        Schema::create('quote_fires', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignIdFor(\App\Models\Quote::class)->constrained();
            $table->foreignIdFor(\App\Models\QuoteCreditType::class)->constrained();
            $table->foreignIdFor(\App\Models\QuoteFireRiskType::class)->constrained();
            $table->foreignIdFor(\App\Models\QuoteFireConstructionType::class)->constrained();
            $table->foreignIdFor(\App\Models\Customer::class, 'co_debtor_id')->nullable()->constrained();
            $table->boolean('guarantor')->default(false);
            $table->integer('deadline')->default(0);
            $table->decimal('property_value', 18, 2)->default(0);
            $table->decimal('loan_value', 18, 2)->default(0);
            $table->text('property_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_fires');
    }
};
