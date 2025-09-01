<?php

namespace App\Filament\Resources\ZohoOauthRefreshTokens\Pages;

use App\Filament\Resources\ZohoOauthRefreshTokens\ZohoOauthRefreshTokenResource;
use App\UseCases\CreateRefreshTokenUseCase;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

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
                    app(CreateRefreshTokenUseCase::class)->handle($data['code']);

                    Notification::make()
                        ->title('Refresh Token Generated')
                        ->success()
                        ->send();
                }),
        ];
    }
}
