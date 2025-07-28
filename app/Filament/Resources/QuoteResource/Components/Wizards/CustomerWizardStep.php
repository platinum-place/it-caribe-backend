<?php

namespace App\Filament\Resources\QuoteResource\Components\Wizards;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;

class CustomerWizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('Customer'))
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
                    ->required()
                    ->live(debounce: 2000)
                    ->afterStateUpdated(function ($get, $set, $state) {
                        $set('customer_age', Carbon::parse($state)->age);
                    }),

                Hidden::make('age'),

                TextInput::make('email')
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
            ])
            ->columns();
    }
}
