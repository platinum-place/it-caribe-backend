<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Str;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('reset_password')
                ->schema([
                    TextInput::make('password')
                        ->default(Str::random())
                        ->required()
                        ->password()
                        ->revealable()
                        ->copyable(),
                ])
                ->action(function (array $data) {
                    $this->record->update(['password' => $data['password']]);

                    Notification::make()
                        ->title('Saved successfully')
                        ->warning()
                        ->send();
                }),
        ];
    }
}
