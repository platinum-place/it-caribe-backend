<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\Vehicles\Schemas;

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
                TextInput::make('vehicle_make_id')
                    ->required()
                    ->numeric(),
                TextInput::make('vehicle_model_id')
                    ->required()
                    ->numeric(),
                TextInput::make('vehicle_type_id')
                    ->required()
                    ->numeric(),
                TextInput::make('vehicle_use_id')
                    ->numeric(),
                TextInput::make('vehicle_activity_id')
                    ->numeric(),
                TextInput::make('vehicle_loan_type_id')
                    ->numeric(),
                TextInput::make('vehicle_utility_id')
                    ->numeric(),
                TextInput::make('vehicle_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('vehicle_loan_amount')
                    ->required()
                    ->numeric(),
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
