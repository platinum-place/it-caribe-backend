<?php

namespace App\Filament\Resources\Zoho\ZohoOauthAccessTokens\Pages;

use App\Filament\Resources\Zoho\ZohoOauthAccessTokens\ZohoOauthAccessTokenResource;
use Filament\Resources\Pages\CreateRecord;

class CreateZohoOauthAccessToken extends CreateRecord
{
    protected static string $resource = ZohoOauthAccessTokenResource::class;
}
