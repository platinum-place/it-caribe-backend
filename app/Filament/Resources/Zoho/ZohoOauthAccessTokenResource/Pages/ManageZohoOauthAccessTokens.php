<?php

namespace App\Filament\Resources\Zoho\ZohoOauthAccessTokenResource\Pages;

use App\Filament\Resources\Zoho\ZohoOauthAccessTokenResource;
use Filament\Resources\Pages\ManageRecords;

class ManageZohoOauthAccessTokens extends ManageRecords
{
    protected static string $resource = ZohoOauthAccessTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
