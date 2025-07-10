<?php

namespace App\Filament\Resources\ZohoOauthAccessTokenResource\Pages;

use App\Filament\Resources\ZohoOauthAccessTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZohoOauthAccessToken extends EditRecord
{
    protected static string $resource = ZohoOauthAccessTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
