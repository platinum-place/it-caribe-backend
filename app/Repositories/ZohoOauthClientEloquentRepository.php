<?php

namespace App\Repositories;

use App\Contracts\ZohoOauthClientRepositoryInterface;
use App\Entities\ZohoOauthClientEntity;
use App\Models\ZohoOauthClient;

class ZohoOauthClientEloquentRepository implements ZohoOauthClientRepositoryInterface
{
    public function findLast(): ZohoOauthClientEntity
    {
        $record = ZohoOauthClient::query()->latest()->firstOrFail();

        return new ZohoOauthClientEntity(
            $record->id,
            $record->client_id,
            $record->client_secret,
            $record->redirect_uri,
        );
    }
}
