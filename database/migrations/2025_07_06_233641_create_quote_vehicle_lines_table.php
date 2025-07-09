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
            $table->string('name');
            $table->foreignIdFor(\App\Models\QuoteVehicle::class)->constrained();
            $table->decimal('unit_price');
            $table->integer('quantity');
            $table->decimal('subtotal');
            $table->decimal('tax_rate')->nullable();
            $table->decimal('tax_amount')->default(0);
            $table->decimal('total');
            $table->decimal('life_amount')->default(0);

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
