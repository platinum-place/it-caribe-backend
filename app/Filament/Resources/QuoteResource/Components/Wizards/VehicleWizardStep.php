<?php

namespace App\Filament\Resources\QuoteResource\Components\Wizards;

use App\Models\VehicleActivity;
use App\Models\VehicleColor;
use App\Models\VehicleLoanType;
use App\Models\VehicleUse;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;

class VehicleWizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('Vehicle'))
            ->schema([
                TextInput::make('chassis')
                    ->label('Chasis')
                    ->required(),

                TextInput::make('license_plate')
                    ->label('Placa'),

                Select::make('vehicle_colors')
                    ->label('Color')
                    ->options(VehicleColor::pluck('name', 'id'))
                    ->multiple(),

                Select::make('vehicle_activity_id')
                    ->label('Actividad del Vehículo')
                    ->options(VehicleActivity::pluck('name', 'id')),

                Select::make('vehicle_use_id')
                    ->label('Uso')
                    ->options(VehicleUse::pluck('name', 'id'))
                    ->required(),

                Select::make('vehicle_loan_type_id')
                    ->label('Tipo de préstamo')
                    ->required()
                    ->options(VehicleLoanType::pluck('name', 'id')),

                DatePicker::make('start_date')
                    ->translateLabel()
                    ->required()
                    ->default(now()),

                DatePicker::make('end_date')
                    ->translateLabel()
                    ->minDate(now())
                    ->maxDate(now()->addDays(30))
                    ->default(now()->addDays(30))
                    ->required(),

                TextInput::make('loan_amount')
                    ->label('Valor del Préstamo')
                    ->numeric()
                    ->required()
                    ->prefix('$'),
            ])
            ->columns();
    }
}
