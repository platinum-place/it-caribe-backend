<?php

namespace App\Filament\Branch\Resources\QuoteLives\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QuoteLifeForm
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
                TextInput::make('quote_life_credit_type_id')
                    ->required()
                    ->numeric(),
                TextInput::make('co_borrower_id')
                    ->numeric(),
                Toggle::make('guarantor')
                    ->required(),
                TextInput::make('deadline_month')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('deadline_year')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('insured_amount')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
