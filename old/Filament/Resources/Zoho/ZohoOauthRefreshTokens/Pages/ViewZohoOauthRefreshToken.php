<?php

namespace App\Filament\Resources\Zoho\ZohoOauthRefreshTokens\Pages;

use old\Filament\Resources\Zoho\ZohoOauthRefreshTokens\ZohoOauthRefreshTokenResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewZohoOauthRefreshToken extends ViewRecord
{
    protected static string $resource = ZohoOauthRefreshTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
