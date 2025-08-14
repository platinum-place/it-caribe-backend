<?php

namespace App\Filament\Forms\Components\Wizards;

use App\Models\CRM\LeadType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard\Step;

class CreateLeadWizardStep
{
    public static function make(): Step
    {
        return Step::make(__('Debtor'))
            ->schema([
                TextInput::make('lead.first_name')
                    ->translateLabel()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $lastName = $get('lead.last_name');
                        $fullName = trim(($state ?? '').' '.($lastName ?? ''));
                        $set('lead.full_name', $fullName);
                    }),

                TextInput::make('lead.last_name')
                    ->translateLabel()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $firstName = $get('lead.first_name');
                        $fullName = trim(($firstName ?? '').' '.($state ?? ''));
                        $set('lead.full_name', $fullName);
                    }),

                Hidden::make('lead.full_name'),

                TextInput::make('lead.identity_number')
                    ->translateLabel()
                    ->required(),
                DatePicker::make('lead.birth_date')
                    ->translateLabel()
                    ->required(),
                TextInput::make('lead.email')
                    ->translateLabel()
                    ->email(),
                TextInput::make('lead.mobile_phone')
                    ->translateLabel()
                    ->tel()
                    ->required()
                    ->mask('999-999-9999'),
                TextInput::make('lead.home_phone')
                    ->translateLabel()
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('lead.work_phone')
                    ->translateLabel()
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('lead.address')
                    ->translateLabel()
                    ->columnSpanFull(),
                Select::make('lead.lead_type_id')
                    ->label('Tipo')
                    ->options(LeadType::pluck('name', 'id')),
            ])
            ->columns();
    }
}
