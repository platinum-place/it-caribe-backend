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
            $table->foreignIdFor(\Modules\Vehicle\Models\Vehicle::class)->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Models\VehicleMake::class)->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Models\VehicleModel::class)->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Models\VehicleType::class)->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Models\VehicleUse::class)->nullable()->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Models\VehicleActivity::class)->nullable()->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Models\VehicleLoanType::class)->nullable()->constrained();
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
