<?php

namespace App\Filament\Resources\QuoteResource\Components\Wizards;

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
                    ->label(__('First name'))
                    ->required(),
                TextInput::make('co_debtor_last_name')
                    ->label(__('Last name'))
                    ->required(),
                TextInput::make('co_debtor_identity_number')
                    ->label(__('Identity number'))
                    ->required(),
                DatePicker::make('co_debtor_birth_date')
                    ->label(__('Birth date'))
                    ->required(),
                TextInput::make('co_debtor_email')
                    ->label(__('Email'))
                    ->email(),
                TextInput::make('co_debtor_mobile_phone')
                    ->label(__('Mobile phone'))
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('co_debtor_home_phone')
                    ->label(__('Home phone'))
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('co_debtor_work_phone')
                    ->label(__('Work phone'))
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('co_debtor_address')
                    ->label(__('Address'))
                    ->columnSpanFull(),
            ])
            ->columns();
    }
}
