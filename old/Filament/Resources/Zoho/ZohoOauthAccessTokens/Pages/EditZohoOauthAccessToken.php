<?php

namespace App\Filament\Resources\Zoho\ZohoOauthAccessTokens\Pages;

use old\Filament\Resources\Zoho\ZohoOauthAccessTokens\ZohoOauthAccessTokenResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditZohoOauthAccessToken extends EditRecord
{
    protected static string $resource = ZohoOauthAccessTokenResource::class;

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
