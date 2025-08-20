<?php

namespace App\Models\Quote;

use App\Enums\Quote\QuoteLineStatusEnum;
use App\Models\CRM\Lead;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_type_id', 'quote_status_id', 'lead_id',
        'attachments', 'start_date', 'end_date',
        'responsible_id', 'created_by', 'updated_by', 'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'attachments' => 'array',
        ];
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function quoteLine(): HasMany
    {
        return $this->hasMany(QuoteLine::class);
    }

    public function selectedLine(): HasOne
    {
        return $this->hasOne(QuoteLine::class)
            ->where('quote_line_status_id', QuoteLineStatusEnum::ACCEPTED->value);
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
