<?php

namespace App\Filament\Resources\Zoho\ZohoOauthRefreshTokenResource\Pages;

use App\Filament\Resources\Zoho\ZohoOauthRefreshTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageZohoOauthRefreshTokens extends ManageRecords
{
    protected static string $resource = ZohoOauthRefreshTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
