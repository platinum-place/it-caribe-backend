<?php

namespace App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuoteVehicleLineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('quote_vehicle_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quote_line_id')
                    ->required()
                    ->numeric(),
                TextInput::make('life_amount')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('latest_expenses')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('markup')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('vehicle_rate')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
