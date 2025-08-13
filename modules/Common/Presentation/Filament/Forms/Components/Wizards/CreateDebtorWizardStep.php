<?php

namespace Modules\Common\Presentation\Filament\Forms\Components\Wizards;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use Modules\CRM\Infrastructure\Persistence\Models\DebtorType;
use Filament\Schemas\Components\Wizard\Step;

class CreateDebtorWizardStep
{
    public static function make(): Step
    {
        return Step::make(__('Debtor'))
            ->schema([
                TextInput::make('debtor.first_name')
                    ->translateLabel()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $lastName = $get('debtor.last_name');
                        $fullName = trim(($state ?? '') . ' ' . ($lastName ?? ''));
                        $set('debtor.full_name', $fullName);
                    }),

                TextInput::make('debtor.last_name')
                    ->translateLabel()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $firstName = $get('debtor.first_name');
                        $fullName = trim(($firstName ?? '') . ' ' . ($state ?? ''));
                        $set('debtor.full_name', $fullName);
                    }),

                Hidden::make('debtor.full_name'),

                TextInput::make('debtor.identity_number')
                    ->translateLabel()
                    ->required(),
                DatePicker::make('debtor.birth_date')
                    ->translateLabel()
                    ->required(),
                TextInput::make('debtor.email')
                    ->translateLabel()
                    ->email(),
                TextInput::make('debtor.mobile_phone')
                    ->translateLabel()
                    ->tel()
                    ->required()
                    ->mask('999-999-9999'),
                TextInput::make('debtor.home_phone')
                    ->translateLabel()
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('debtor.work_phone')
                    ->translateLabel()
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('debtor.address')
                    ->translateLabel()
                    ->columnSpanFull(),
                Select::make('debtor.debtor_type_id')
                    ->label('Tipo')
                    ->options(DebtorType::pluck('name', 'id')),
            ])
            ->columns();
    }
}
