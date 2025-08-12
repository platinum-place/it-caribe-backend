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
        Schema::create('quote_vehicle_lines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('quote_vehicle_id')->constrained('quote_vehicles');
            $table->foreignId('quote_line_id')->constrained('quote_lines');
            $table->decimal('life_amount', 18, 2)->default(0);
            $table->decimal('latest_expenses', 18, 2)->default(0);
            $table->decimal('markup', 18, 2)->default(0);
            $table->float('vehicle_rate')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_vehicle_lines');
    }
};
