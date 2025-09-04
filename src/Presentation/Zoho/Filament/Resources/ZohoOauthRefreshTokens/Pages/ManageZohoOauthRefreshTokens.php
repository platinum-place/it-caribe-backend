<?php

namespace Modules\Presentation\Zoho\Filament\Resources\ZohoOauthRefreshTokens\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Modules\Application\Zoho\UseCases\CreateRefreshTokenUseCase;
use Modules\Presentation\Zoho\Filament\Resources\ZohoOauthRefreshTokens\ZohoOauthRefreshTokenResource;

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
