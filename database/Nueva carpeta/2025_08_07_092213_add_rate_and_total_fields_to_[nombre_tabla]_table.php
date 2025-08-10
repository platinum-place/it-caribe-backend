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
        Schema::table('quote_debt_unemployment_lines', function (Blueprint $table) {
            $table->decimal('rate2', 18, 2)->default(0);
            $table->decimal('total2', 18, 2)->default(0);
            $table->decimal('total1', 18, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quote_debt_unemployment_lines', function (Blueprint $table) {
            $table->dropColumn(['rate2', 'total2', 'total1']);
        });
    }
};
