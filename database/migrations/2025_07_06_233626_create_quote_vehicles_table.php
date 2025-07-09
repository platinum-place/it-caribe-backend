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
            $table->foreignIdFor(\App\Models\Quote::class)->constrained();
            $table->foreignIdFor(\App\Models\Vehicle::class)->constrained();
            $table->foreignIdFor(\App\Models\VehicleMake::class)->constrained();
            $table->foreignIdFor(\App\Models\VehicleModel::class)->constrained();
            $table->foreignIdFor(\App\Models\VehicleType::class)->constrained();
            $table->foreignIdFor(\App\Models\VehicleUse::class)->constrained();
            $table->foreignIdFor(\App\Models\VehicleActivity::class)->constrained();
            $table->foreignIdFor(\App\Models\VehicleAccessory::class)->constrained();
            $table->foreignIdFor(\App\Models\VehicleRoute::class)->constrained();
            $table->decimal('vehicle_amount');
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
