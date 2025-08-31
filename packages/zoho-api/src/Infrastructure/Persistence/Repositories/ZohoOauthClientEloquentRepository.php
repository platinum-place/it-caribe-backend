<?php

namespace Root\ZohoApi\Infrastructure\Persistence\Repositories;

use Root\ZohoApi\Domain\Contracts\ZohoOauthClientRepositoryInterface;
use Root\ZohoApi\Domain\Entities\ZohoOauthClientEntity;
use Root\ZohoApi\Infrastructure\Persistence\Models\ZohoOauthClient;

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
