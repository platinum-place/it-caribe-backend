<?php

namespace App\Filament\Resources\QuoteLifeResource\Components\Wizard;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;

class CoDebtorWizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('Co-debtor'))
            ->schema([
                TextInput::make('co_debtor_first_name')
                    ->translateLabel()
                    ->required(),
                TextInput::make('co_debtor_last_name')
                    ->translateLabel()
                    ->required(),
                TextInput::make('co_debtor_identity_number')
                    ->translateLabel()
                    ->required(),
                DatePicker::make('co_debtor_birth_date')
                    ->translateLabel()
                    ->required(),
                TextInput::make('co_debtor_email')
                    ->translateLabel()
                    ->email(),
                TextInput::make('co_debtor_mobile_phone')
                    ->translateLabel()
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('co_debtor_home_phone')
                    ->translateLabel()
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('co_debtor_work_phone')
                    ->translateLabel()
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('co_debtor_address')
                    ->translateLabel()
                    ->columnSpanFull(),
            ])
            ->columns();
    }
}
