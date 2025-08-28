<?php

namespace App\Filament\Resources\Zoho\ZohoOauthAccessTokens\Pages;

use App\Filament\Resources\Zoho\ZohoOauthAccessTokens\ZohoOauthAccessTokenResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewZohoOauthAccessToken extends ViewRecord
{
    protected static string $resource = ZohoOauthAccessTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
