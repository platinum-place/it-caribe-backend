<?php

namespace Modules\Infrastructure\Zoho\Persistence\Repositories;

use Modules\Domain\Zoho\Entities\ZohoOauthClientEntity;
use Modules\Domain\Zoho\Repositories\ZohoOauthClientRepositoryInterface;
use Modules\Infrastructure\Zoho\Persistence\Models\ZohoOauthClient;

class ZohoOauthClientEloquentRepository implements ZohoOauthClientRepositoryInterface
{
    public function findLast(): ZohoOauthClientEntity
    {
        return $this->returnEntity(
            ZohoOauthClient::query()->latest()->firstOrFail()
        );
    }

    protected function returnEntity(ZohoOauthClient $record): ZohoOauthClientEntity
    {
        return new ZohoOauthClientEntity(
            $record->id,
            $record->client_id,
            $record->client_secret,
            $record->redirect_uri,
        );
    }
}
