<?php

namespace Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QuoteFireForm
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
                TextInput::make('quote_fire_construction_type_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quote_fire_credit_type_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quote_fire_risk_type_id')
                    ->required()
                    ->numeric(),
                Select::make('branch_id')
                    ->relationship('branch', 'name'),
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
                TextInput::make('appraisal_value')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('financed_value')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('property_address')
                    ->columnSpanFull(),
            ]);
    }
}
