<?php

namespace Modules\Zoho\Filament\Resources\ZohoOauthClients\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Zoho\Filament\Resources\ZohoOauthClients\ZohoOauthClientResource;

class ManageZohoOauthClients extends ManageRecords
{
    protected static string $resource = ZohoOauthClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
