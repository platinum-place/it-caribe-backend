<?php

namespace App\Filament\Resources\Zoho\ZohoOauthAccessTokens\Pages;

use App\Filament\Resources\Zoho\ZohoOauthAccessTokens\ZohoOauthAccessTokenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListZohoOauthAccessTokens extends ListRecords
{
    protected static string $resource = ZohoOauthAccessTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
