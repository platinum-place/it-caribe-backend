<?php

namespace App\Filament\Resources\Zoho\ZohoOauthRefreshTokens\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ZohoOauthRefreshTokenForm
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
                TextInput::make('api_domain'),
                TextInput::make('token_type'),
            ]);
    }
}
