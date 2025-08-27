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
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');

            $table->foreignId('quote_id')->constrained('quotes');

            $table->foreignId('quote_fire_construction_type_id')->constrained('quote_fire_construction_types');
            $table->foreignId('quote_fire_credit_type_id')->constrained('quote_fire_credit_types');
            $table->foreignId('quote_fire_risk_type_id')->constrained('quote_fire_risk_types');

            $table->boolean('guarantor')->default(false);
            $table->foreignId('co_borrower_id')->nullable()->constrained('leads');
            $table->boolean('guarantor')->default(false);
            $table->integer('deadline_month')->default(0);
            $table->integer('deadline_year')->default(0);
            $table->decimal('appraisal_value', 18, 2)->default(0);
            $table->decimal('financed_value', 18, 2)->default(0);
            $table->text('property_address', 18, 2)->nullable();
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
