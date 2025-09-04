<?php

namespace Modules\Infrastructure\Quotations\Core\Persistence\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Infrastructure\CRM\Persistence\Models\Lead;
use Modules\Infrastructure\Organization\Locations\Persistence\Models\Branch;
use Modules\Infrastructure\Quotations\Core\Persistence\Observers\QuoteObserver;

#[ObservedBy([QuoteObserver::class])]
class Quote extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_type_id', 'quote_status_id', 'lead_id',
        'attachments', 'start_date', 'end_date',
        'branch_id', 'created_by', 'updated_by', 'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'attachments' => 'array',
        ];
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(QuoteStatus::class, 'quote_status_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(QuoteType::class, 'quote_type_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function lines(): HasMany
    {
        return $this->hasMany(QuoteLine::class);
    }

    public function acceptedLine(): HasOne
    {
        return $this->hasOne(QuoteLine::class)->accepted();
    }

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
}
