<?php

namespace Modules\Infrastructure\Common\Persistence\Repositories;

use Modules\Domain\Common\Entities\ZohoOauthClientEntity;
use Modules\Domain\Common\Repositories\ZohoOauthClientRepositoryInterface;
use Modules\Infrastructure\Common\Persistence\Models\ZohoOauthClient;

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
