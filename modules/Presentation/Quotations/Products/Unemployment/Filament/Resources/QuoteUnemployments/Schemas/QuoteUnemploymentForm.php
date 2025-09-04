<?php

namespace Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemployments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuoteUnemploymentForm
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
                TextInput::make('quote_unemployment_payment_type_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quote_unemployment_employment_type_id')
                    ->required()
                    ->numeric(),
                Select::make('branch_id')
                    ->relationship('branch', 'name'),
                TextInput::make('quote_id')
                    ->required()
                    ->numeric(),
                TextInput::make('deadline_month')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('deadline_year')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('loan_installment')
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
