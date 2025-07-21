<?php

namespace App\Filament\Resources\QuoteVehicleResource\Components\Forms;

use App\Models\VehicleActivity;
use App\Models\VehicleColor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;

class VehicleWizardForm
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
            ])
            ->columns();
    }
}
