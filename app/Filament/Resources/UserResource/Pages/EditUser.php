<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\Action::make('edit_permissions')
                ->translateLabel()
                ->url(route('filament.admin.resources.users.edit-permissions', $this->record)),
            Actions\Action::make('reset_password')
                ->color('danger')
                ->translateLabel()
                ->form([
                    TextInput::make('password')
                        ->default(\Str::random())
                        ->required()
                        ->translateLabel(),
                ])
                ->action(function ($record, array $data) {
                    $record->update(['password' => $data['password']]);

                    Notification::make()
                        ->title(__('Password changed'))
                        ->warning()
                        ->send();
                }),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
