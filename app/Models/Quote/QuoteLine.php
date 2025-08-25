<?php

namespace App\Models\Quote;

use App\Enums\Quote\QuoteLineStatusEnum;
use App\Observers\Quote\QuoteLineObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([QuoteLineObserver::class])]
class QuoteLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'quote_id', 'unit_price',
        'quantity', 'subtotal', 'tax_rate', 'tax_amount', 'total',
        'amount_taxed', 'quote_line_status_id', 'created_by', 'updated_by', 'deleted_by',
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

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(QuoteLineStatus::class);
    }

    #[Scope]
    protected function accepted(Builder $query): void
    {
        $query->where('quote_line_status_id', QuoteLineStatusEnum::ACCEPTED->value);
    }
}
