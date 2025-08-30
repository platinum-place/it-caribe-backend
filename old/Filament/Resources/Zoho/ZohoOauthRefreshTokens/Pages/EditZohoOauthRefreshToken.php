<?php

namespace App\Filament\Resources\Zoho\ZohoOauthRefreshTokens\Pages;

use old\Filament\Resources\Zoho\ZohoOauthRefreshTokens\ZohoOauthRefreshTokenResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditZohoOauthRefreshToken extends EditRecord
{
    protected static string $resource = ZohoOauthRefreshTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
