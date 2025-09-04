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
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->foreignId('vehicle_make_id')->constrained('vehicle_makes');
            $table->foreignId('vehicle_model_id')->constrained('vehicle_models');
            $table->foreignId('vehicle_type_id')->constrained('vehicle_types');
            $table->foreignId('vehicle_use_id')->nullable()->constrained('vehicle_uses');
            $table->foreignId('vehicle_activity_id')->nullable()->constrained('vehicle_activities');
            $table->foreignId('vehicle_loan_type_id')->nullable()->constrained('vehicle_loan_types');
            $table->foreignId('vehicle_utility_id')->nullable()->constrained('vehicle_utilities');
            $table->year('vehicle_year')->nullable();
            $table->string('chassis')->nullable();
            $table->string('license_plate')->nullable();

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
