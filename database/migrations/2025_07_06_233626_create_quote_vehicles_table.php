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
            $table->foreignIdFor(\App\Models\Quotes\Quote::class)->constrained();
            $table->foreignIdFor(\App\Models\Vehicles\Vehicle::class)->constrained();
            $table->foreignIdFor(\App\Models\Vehicles\VehicleMake::class)->constrained();
            $table->foreignIdFor(\App\Models\Vehicles\VehicleModel::class)->constrained();
            $table->foreignIdFor(\App\Models\Vehicles\VehicleType::class)->constrained();
            $table->foreignIdFor(\App\Models\Vehicles\VehicleUse::class)->nullable()->constrained();
            $table->foreignIdFor(\App\Models\Vehicles\VehicleActivity::class)->nullable()->constrained();
            $table->decimal('vehicle_amount', 18, 2);
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
