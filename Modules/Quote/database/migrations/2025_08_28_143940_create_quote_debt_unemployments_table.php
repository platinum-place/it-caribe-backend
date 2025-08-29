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
        Schema::create('quote_debt_unemployments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');

            $table->foreignId('quote_id')->constrained('quotes');
            $table->foreignId('quote_unemployment_employment_type_id')->constrained('quote_unemployment_employment_types');
            $table->foreignId('vehicle_id')->constrained('vehicles');

            $table->integer('deadline_month')->default(0);
            $table->integer('deadline_year')->default(0);
            $table->decimal('vehicle_amount', 18, 2);
            $table->decimal('loan_amount', 18, 2);
            $table->decimal('insured_amount', 18, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_debt_unemployments');
    }
};
