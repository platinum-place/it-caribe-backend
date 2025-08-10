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
        Schema::create('quote_lives', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignIdFor(\Modules\Quote\Infrastructure\Persistance\Models\Quote::class)->constrained();
            $table->foreignIdFor(\App\Models\QuoteLifeCreditType::class)->constrained();
            $table->foreignIdFor(\Modules\Quote\Infrastructure\Persistance\Models\Debtor::class, 'co_debtor_id')->nullable()->constrained();
            $table->boolean('guarantor')->default(false);
            $table->integer('deadline')->default(0);
            $table->decimal('insured_amount', 18, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_lives');
    }
};
