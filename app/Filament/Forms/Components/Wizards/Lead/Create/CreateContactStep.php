<?php

namespace App\Filament\Forms\Components\Wizards\Lead\Create;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard\Step;
use Modules\Infrastructure\CRM\Persistence\Models\LeadType;

class CreateContactStep
{
    public static function make(): Step
    {
        return Step::make('Deudor 2/2')
            ->schema([
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

                Select::make('lead.lead_type_id')
                    ->label('Tipo de cliente')
                    ->options(LeadType::pluck('name', 'id')),

                TextInput::make('lead.address')
                    ->label('Dirección')
                    ->columnSpanFull(),
            ])
            ->columns();
    }
}
