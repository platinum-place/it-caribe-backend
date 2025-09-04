<?php

namespace App\Filament\Forms\Components\Wizards\Lead\Create;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard\Step;
use Modules\Infrastructure\CRM\Persistence\Models\LeadType;

class CreateStep
{
    public static function make(): Step
    {
        return Step::make('Deudor 1/2')
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

                Select::make('lead.lead_type_id')
                    ->label('Tipo de cliente')
                    ->options(LeadType::pluck('name', 'id')),
            ])
            ->columns();
    }
}
