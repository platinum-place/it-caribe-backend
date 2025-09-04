<?php

namespace Modules\Infrastructure\Quotations\Products\Life\Persistence\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Infrastructure\Quotations\Core\Persistence\Models\QuoteLine;
use Modules\Infrastructure\Quotations\Products\Life\Persistence\Observers\QuoteLifeLineObserver;

#[ObservedBy([QuoteLifeLineObserver::class])]
class QuoteLifeLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_life_id', 'quote_line_id', 'borrower_amount',
        'co_borrower_amount', 'borrower_rate', 'co_borrower_rate',
        'created_by', 'updated_by', 'deleted_by',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'deleted_by');
    }

    public function quoteLife(): BelongsTo
    {
        return $this->belongsTo(QuoteLife::class, 'quote_life_id');
    }

    public function quoteLine(): BelongsTo
    {
        return $this->belongsTo(QuoteLine::class, 'quote_line_id');
    }
}
