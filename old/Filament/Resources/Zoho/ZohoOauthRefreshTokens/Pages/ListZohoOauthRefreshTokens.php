<?php

namespace App\Filament\Resources\Zoho\ZohoOauthRefreshTokens\Pages;

use old\Filament\Resources\Zoho\ZohoOauthRefreshTokens\ZohoOauthRefreshTokenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListZohoOauthRefreshTokens extends ListRecords
{
    protected static string $resource = ZohoOauthRefreshTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
