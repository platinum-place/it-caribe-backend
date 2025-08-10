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
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->foreignIdFor(\Modules\Quote\Infrastructure\Persistance\Models\QuoteType::class)->constrained();
            $table->foreignIdFor(\Modules\Quote\Infrastructure\Persistance\Models\QuoteStatus::class)->constrained();
            $table->foreignIdFor(\Modules\Quote\Infrastructure\Persistance\Models\Debtor::class)->nullable()->constrained();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->foreignIdFor(\App\Models\User::class, 'responsible_id')->nullable()->constrained();
            $table->json('attachments')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
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
