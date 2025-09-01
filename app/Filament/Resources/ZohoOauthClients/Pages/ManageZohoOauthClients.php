<?php

namespace App\Filament\Resources\ZohoOauthClients\Pages;

use App\Filament\Resources\ZohoOauthClients\ZohoOauthClientResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

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
