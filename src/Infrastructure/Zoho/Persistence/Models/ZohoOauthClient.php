<?php

namespace Modules\Infrastructure\Zoho\Persistence\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Infrastructure\Zoho\Persistence\Observers\ZohoOauthClientObserver;

#[ObservedBy([ZohoOauthClientObserver::class])]
class ZohoOauthClient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id', 'client_secret', 'redirect_uri',
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
}
