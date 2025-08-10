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
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('name');
            $table->string('code')->nullable();
            $table->foreignIdFor(\Modules\Vehicle\Infrastructure\Persistence\Models\VehicleMake::class)->constrained();
            $table->foreignIdFor(\Modules\Vehicle\Infrastructure\Persistence\Models\VehicleType::class)->constrained();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->foreignIdFor(\Modules\Vehicle\Infrastructure\Persistence\Models\VehicleUtility::class)->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_models');
    }
};
