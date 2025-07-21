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
        Schema::create('quote_lines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('name');
            $table->string('description')->nullable();
            $table->foreignIdFor(\App\Models\Quote::class)->constrained();
            $table->foreignIdFor(\App\Models\QuoteLineStatus::class)->constrained();
            $table->string('id_crm')->nullable();
            $table->decimal('unit_price', 18, 2);
            $table->integer('quantity');
            $table->decimal('subtotal', 18, 2);
            $table->decimal('amount_taxed', 18, 2);
            $table->decimal('tax_rate', 18, 2)->nullable();
            $table->decimal('tax_amount', 18, 2)->default(0);
            $table->decimal('total', 18, 2);
            $table->decimal('insurance_rate', 18, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_lines');
    }
};
