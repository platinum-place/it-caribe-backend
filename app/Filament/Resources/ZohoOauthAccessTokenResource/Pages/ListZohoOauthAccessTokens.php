<?php

namespace App\Filament\Resources\ZohoOauthAccessTokenResource\Pages;

use App\Filament\Resources\ZohoOauthAccessTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListZohoOauthAccessTokens extends ListRecords
{
    protected static string $resource = ZohoOauthAccessTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
