<?php

namespace Root\ZohoApi\Presentation\Filament\Resources\ZohoOauthAccessTokens\Pages;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Root\ZohoApi\Application\UseCases\CreateAccessTokenUseCase;
use Root\ZohoApi\Presentation\Filament\Resources\ZohoOauthAccessTokens\ZohoOauthAccessTokenResource;

class ManageZohoOauthAccessTokens extends ManageRecords
{
    protected static string $resource = ZohoOauthAccessTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generate_access_token')
                ->requiresConfirmation()
                ->action(function () {
                    app(CreateAccessTokenUseCase::class)->handle();

                    Notification::make()
                        ->title('Access Token Generated')
                        ->success()
                        ->send();
                }),
        ];
    }
}
