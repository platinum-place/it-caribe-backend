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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->year('vehicle_year');
            $table->string('chassis', 50);
            $table->string('license_plate', 20)->nullable();
            $table->foreignIdFor(\App\Models\VehicleMake::class)->constrained();
            $table->foreignIdFor(\App\Models\VehicleModel::class)->constrained();
            $table->foreignIdFor(\App\Models\VehicleType::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
