<?php

namespace App\Filament\Forms\Components\Wizards;

use App\Models\LeadType;
use Filament\Forms\Components\DatePicker;
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
                    ->label('Nombre')
                    ->required(),
                TextInput::make('lead.last_name')
                    ->label('Apellido')
                    ->required(),
                TextInput::make('lead.identity_number')
                    ->label('Cédula')
                    ->required(),
                DatePicker::make('lead.birth_date')
                    ->label('Fecha de nacimiento')
                    ->required(),
                TextInput::make('lead.email')
                    ->label('Correo electrónico')
                    ->email(),
                TextInput::make('lead.mobile_phone')
                    ->label('Celular')
                    ->tel()
                    ->required()
                    ->mask('999-999-9999'),
                TextInput::make('lead.home_phone')
                    ->label('Teléfono residencial')
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('lead.work_phone')
                    ->label('Teléfono laboral')
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('lead.address')
                    ->label('Dirección')
                    ->columnSpanFull(),
                Select::make('lead.lead_type_id')
                    ->label('Tipo de cliente')
                    ->options(LeadType::pluck('name', 'id')),
            ])
            ->columns();
    }
}
