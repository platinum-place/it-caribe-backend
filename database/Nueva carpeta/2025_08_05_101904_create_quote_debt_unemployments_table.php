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
            $table->foreignIdFor(\Modules\Quote\Infrastructure\Persistance\Models\Quote::class)->constrained();
            $table->foreignIdFor(\App\Models\Vehicle\Vehicle::class)->constrained();
            $table->foreignIdFor(\App\Models\Vehicle\VehicleMake::class)->constrained();
            $table->foreignIdFor(\App\Models\Vehicle\VehicleModel::class)->constrained();
            $table->foreignIdFor(\App\Models\Vehicle\VehicleType::class)->constrained();
            $table->foreignIdFor(\App\Models\Vehicle\VehicleUse::class)->nullable()->constrained();
            $table->foreignIdFor(\App\Models\Vehicle\VehicleActivity::class)->nullable()->constrained();
            $table->foreignIdFor(\App\Models\Vehicle\VehicleLoanType::class)->nullable()->constrained();
            $table->decimal('vehicle_amount', 18, 2);
            $table->decimal('loan_amount', 18, 2);
            $table->decimal('insured_amount', 18, 2);
            $table->year('vehicle_year');
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
