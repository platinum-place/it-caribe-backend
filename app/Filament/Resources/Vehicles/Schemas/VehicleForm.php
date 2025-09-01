<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
                TextInput::make('updated_by')
                    ->numeric(),
                TextInput::make('deleted_by')
                    ->numeric(),
                Select::make('vehicle_make_id')
                    ->relationship('vehicleMake', 'name')
                    ->required(),
                Select::make('vehicle_model_id')
                    ->relationship('vehicleModel', 'name')
                    ->required(),
                Select::make('vehicle_type_id')
                    ->relationship('vehicleType', 'name')
                    ->required(),
                Select::make('vehicle_use_id')
                    ->relationship('vehicleUse', 'name'),
                Select::make('vehicle_activity_id')
                    ->relationship('vehicleActivity', 'name'),
                Select::make('vehicle_loan_type_id')
                    ->relationship('vehicleLoanType', 'name'),
                Select::make('vehicle_utility_id')
                    ->relationship('vehicleUtility', 'name'),
                TextInput::make('vehicle_year')
                    ->required()
                    ->numeric(),
                TextInput::make('chassis')
                    ->required(),
                TextInput::make('license_plate')
                    ->required(),
            ]);
    }
}
