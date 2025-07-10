<?php

namespace App\Filament\Resources\ZohoOauthRefreshTokenResource\Pages;

use App\Filament\Resources\ZohoOauthRefreshTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListZohoOauthRefreshTokens extends ListRecords
{
    protected static string $resource = ZohoOauthRefreshTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
