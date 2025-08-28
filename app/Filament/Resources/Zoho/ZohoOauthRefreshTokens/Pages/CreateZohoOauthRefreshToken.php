<?php

namespace App\Filament\Resources\Zoho\ZohoOauthRefreshTokens\Pages;

use App\Filament\Resources\Zoho\ZohoOauthRefreshTokens\ZohoOauthRefreshTokenResource;
use Filament\Resources\Pages\CreateRecord;

class CreateZohoOauthRefreshToken extends CreateRecord
{
    protected static string $resource = ZohoOauthRefreshTokenResource::class;
}
