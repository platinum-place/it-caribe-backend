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
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');

            $table->foreignId('quote_unemployment_payment_type_id')->constrained('quote_unemployment_payment_types');
            $table->foreignId('quote_unemployment_employment_type_id')->constrained('quote_unemployment_employment_types');
            $table->foreignId('branch_id')->nullable()->constrained('branches');

            $table->foreignId('quote_id')->constrained('quotes');

            $table->integer('deadline_month')->default(0);
            $table->integer('deadline_year')->default(0);
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
