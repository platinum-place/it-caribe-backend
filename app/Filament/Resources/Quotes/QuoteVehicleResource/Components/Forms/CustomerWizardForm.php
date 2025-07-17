<?php

namespace App\Filament\Resources\Quotes\QuoteVehicleResource\Components\Forms;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;

class CustomerWizardForm
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make('Datos del cliente')
            ->schema([
                TextInput::make('first_name')
                    ->translateLabel()
                    ->required(),
                TextInput::make('last_name')
                    ->translateLabel()
                    ->required(),
                TextInput::make('identity_number')
                    ->translateLabel()
                    ->required(),
                DatePicker::make('birth_date')
                    ->translateLabel()
                    ->required(),
                TextInput::make('correo')
                    ->translateLabel()
                    ->email(),
                TextInput::make('mobile_phone')
                    ->translateLabel()
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('home_phone')
                    ->translateLabel()
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('work_phone')
                    ->translateLabel()
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('address')
                    ->translateLabel()
                    ->columnSpanFull(),
            ]);
    }
}
