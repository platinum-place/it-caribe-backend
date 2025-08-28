<?php

namespace App\Filament\Resources\Zoho\ZohoOauthAccessTokens\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ZohoOauthAccessTokenForm
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
                TextInput::make('scope'),
                TextInput::make('api_domain'),
                TextInput::make('token_type'),
                TextInput::make('expires_in')
                    ->numeric(),
                DateTimePicker::make('expires_at'),
            ]);
    }
}
