<?php

namespace Modules\Zoho\Filament\Resources\ZohoOauthRefreshTokens\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Zoho\Filament\Resources\ZohoOauthRefreshTokens\ZohoOauthRefreshTokenResource;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Mail;

class ManageZohoOauthRefreshTokens extends ManageRecords
{
    protected static string $resource = ZohoOauthRefreshTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generate_refresh_token')
                ->schema([
                    TextInput::make('code')
                        ->required(),
                ])
                ->action(function (array $data) {

                })
        ];
    }
}
