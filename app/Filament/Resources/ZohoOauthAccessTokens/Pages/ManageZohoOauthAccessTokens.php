<?php

namespace App\Filament\Resources\ZohoOauthAccessTokens\Pages;

use App\Filament\Resources\ZohoOauthAccessTokens\ZohoOauthAccessTokenResource;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Modules\Application\Common\UseCases\CreateAccessTokenUseCase;

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
