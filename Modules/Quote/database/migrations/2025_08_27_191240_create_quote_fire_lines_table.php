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
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');

            $table->foreignId('quote_line_id')->constrained('quote_lines');
            $table->foreignId('quote_fire_id')->constrained('quote_fires');

            $table->decimal('borrower_amount', 18, 2)->default(0);
            $table->decimal('co_borrower_amount', 18, 2)->default(0);

            $table->decimal('borrower_rate', 18, 2)->default(0);
            $table->decimal('co_borrower_rate', 18, 2)->default(0);

            $table->decimal('fire_rate', 18, 2)->default(0);

            $table->decimal('fire_amount', 18, 2)->default(0);
            $table->decimal('life_amount', 18, 2)->default(0);
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
