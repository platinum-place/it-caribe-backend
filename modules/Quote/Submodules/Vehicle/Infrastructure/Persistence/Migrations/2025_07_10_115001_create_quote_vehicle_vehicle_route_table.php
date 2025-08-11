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
        Schema::create('quote_vehicle_vehicle_route', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('quote_vehicle_id')->constrained('quote_vehicles');
            $table->foreignId('vehicle_route_id')->constrained('vehicle_routes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_vehicle_vehicle_route');
    }
};
