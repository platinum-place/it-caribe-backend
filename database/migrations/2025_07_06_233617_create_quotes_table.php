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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignIdFor(\App\Models\Quotes\QuoteType::class)->constrained();
            $table->foreignIdFor(\App\Models\Quotes\QuoteStatus::class)->constrained();
            $table->foreignIdFor(\App\Models\Customer::class)->nullable()->constrained();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->json('attachments')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('id_crm')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
