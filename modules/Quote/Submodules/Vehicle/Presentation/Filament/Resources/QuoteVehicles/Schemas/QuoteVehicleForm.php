<?php

namespace Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QuoteVehicleForm
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
                TextInput::make('quote_id')
                    ->required()
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
                TextInput::make('loan_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('vehicle_year')
                    ->required()
                    ->numeric(),
                Toggle::make('is_employee')
                    ->required(),
                Toggle::make('leasing')
                    ->required(),
            ]);
    }
}
