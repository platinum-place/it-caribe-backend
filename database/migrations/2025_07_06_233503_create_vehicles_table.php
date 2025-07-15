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
            $table->year('year');
            $table->string('chassis', 50);
            $table->string('license_plate', 20)->nullable();
            $table->foreignIdFor(\App\Models\Vehicles\VehicleMake::class)->constrained();
            $table->foreignIdFor(\App\Models\Vehicles\VehicleModel::class)->constrained();
            $table->foreignIdFor(\App\Models\Vehicles\VehicleType::class)->constrained();
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
