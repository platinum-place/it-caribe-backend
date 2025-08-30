<?php

namespace App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuoteLifeCreditTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
                TextInput::make('updated_by')
                    ->numeric(),
                TextInput::make('deleted_by')
                    ->numeric(),
            ]);
    }
}
