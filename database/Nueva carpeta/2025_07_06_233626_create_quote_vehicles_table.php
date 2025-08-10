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
        Schema::create('quote_vehicles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignIdFor(\Modules\Quote\Infrastructure\Persistance\Models\Quote::class)->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Infrastructure\Persistence\Models\Vehicle::class)->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Infrastructure\Persistence\Models\VehicleMake::class)->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Infrastructure\Persistence\Models\VehicleModel::class)->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Infrastructure\Persistence\Models\VehicleType::class)->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Infrastructure\Persistence\Models\VehicleUse::class)->nullable()->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Infrastructure\Persistence\Models\VehicleActivity::class)->nullable()->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Infrastructure\Persistence\Models\VehicleLoanType::class)->nullable()->constrained();
            $table->decimal('vehicle_amount', 18, 2);
            $table->decimal('loan_amount', 18, 2);
            $table->year('vehicle_year');
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
