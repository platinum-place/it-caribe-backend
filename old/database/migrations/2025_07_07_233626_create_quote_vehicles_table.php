<?php

namespace Modules\Quote\Vehicle\Infrastructure\Persistence\Migrations;

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
        Schema::create('quote_vehicles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');

            $table->foreignId('quote_id')->constrained('quotes');
            $table->foreignId('vehicle_id')->constrained('vehicles');

            $table->decimal('vehicle_amount', 18, 2);
            $table->decimal('vehicle_loan_amount', 18, 2)->nullable();

            $table->boolean('is_employee')->default(false);
            $table->boolean('leasing')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_vehicles');
    }
};
