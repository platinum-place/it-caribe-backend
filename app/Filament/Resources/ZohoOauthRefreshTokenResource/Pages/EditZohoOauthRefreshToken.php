<?php

namespace App\Filament\Resources\ZohoOauthRefreshTokenResource\Pages;

use App\Filament\Resources\ZohoOauthRefreshTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZohoOauthRefreshToken extends EditRecord
{
    protected static string $resource = ZohoOauthRefreshTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
