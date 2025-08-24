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
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');

            $table->foreignId('quote_id')->constrained('quotes');
            $table->foreignId('quote_life_credit_type_id')->constrained('quote_life_credit_types');
            $table->foreignId('co_borrower_id')->constrained('leads');

            $table->boolean('guarantor')->default(false);
            $table->integer('deadline_month')->default(0);
            $table->integer('deadline_year')->default(0);
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
