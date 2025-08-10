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
        Schema::create('vehicle_vehicle_color', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(\Modules\Vehicle\Infrastructure\Persistence\Models\Vehicle::class)->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Infrastructure\Persistence\Models\VehicleColor::class)->constrained();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_vehicle_color');
    }
};
