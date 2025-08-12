<?php

namespace Modules\Common\Presentation\Filament\Forms\Components\Wizards;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Modules\CRM\Infrastructure\Persistence\Models\DebtorType;

class CreateDebtorWizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('Debtor'))
            ->schema([
                TextInput::make('debtor.first_name')
                    ->translateLabel()
                    ->required(),
                TextInput::make('debtor.last_name')
                    ->translateLabel()
                    ->required(),
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
                    ->required()
                    ->options(DebtorType::pluck('name', 'id')),
            ])
            ->columns();
    }
}
