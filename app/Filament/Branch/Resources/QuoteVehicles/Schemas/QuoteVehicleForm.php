<?php

namespace App\Filament\Branch\Resources\QuoteVehicles\Schemas;

use Filament\Forms\Components\Select;
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
                Select::make('quote_id')
                    ->relationship('quote', 'id')
                    ->required(),
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'id')
                    ->required(),
                TextInput::make('vehicle_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('vehicle_loan_amount')
                    ->numeric(),
                Toggle::make('is_employee')
                    ->required(),
                Toggle::make('leasing')
                    ->required(),
            ]);
    }
}
