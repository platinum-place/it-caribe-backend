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
        Schema::create('zoho_oauth_refresh_tokens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->text('refresh_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zoho_oauth_refresh_tokens');
    }
};
