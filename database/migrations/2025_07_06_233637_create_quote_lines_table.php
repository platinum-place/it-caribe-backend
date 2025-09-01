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
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');

            $table->foreignId('quote_id')->constrained('quotes');
            $table->foreignId('quote_line_status_id')->constrained('quote_line_statuses');

            $table->string('name');
            $table->text('description')->nullable();

            $table->decimal('unit_price', 18, 2);
            $table->integer('quantity');
            $table->decimal('subtotal', 18, 2);
            $table->decimal('amount_taxed', 18, 2);
            $table->decimal('tax_rate', 18, 2)->nullable();
            $table->decimal('tax_amount', 18, 2)->default(0);
            $table->decimal('total', 18, 2);
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
