<?php

namespace App\Filament\Quote\Resources\Quotes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuoteForm
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
                TextInput::make('quote_status_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quote_type_id')
                    ->required()
                    ->numeric(),
                TextInput::make('lead_id')
                    ->required()
                    ->numeric(),
                TextInput::make('responsible_id')
                    ->required()
                    ->numeric(),
                TextInput::make('attachments'),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date'),
            ]);
    }
}
