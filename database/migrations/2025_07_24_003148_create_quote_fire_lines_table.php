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
        Schema::create('quote_fire_lines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignIdFor(\App\Models\QuoteFire::class)->constrained();
            $table->foreignIdFor(\App\Models\QuoteLine::class)->constrained();
            $table->decimal('fire_amount', 18, 2)->default(0);
            $table->decimal('life_amount', 18, 2)->default(0);
            $table->float('fire_rate')->default(0);
            $table->decimal('debtor_amount', 18, 2)->default(0);
            $table->decimal('co_debtor_amount', 18, 2)->default(0);
            $table->float('debtor_rate')->default(0);
            $table->float('co_debtor_rate')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_fire_lines');
    }
};
