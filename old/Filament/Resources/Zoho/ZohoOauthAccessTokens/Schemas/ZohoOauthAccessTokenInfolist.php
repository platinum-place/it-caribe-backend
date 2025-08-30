<?php

namespace App\Filament\Resources\Zoho\ZohoOauthAccessTokens\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ZohoOauthAccessTokenInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
                TextEntry::make('created_by')
                    ->numeric(),
                TextEntry::make('updated_by')
                    ->numeric(),
                TextEntry::make('deleted_by')
                    ->numeric(),
                TextEntry::make('scope'),
                TextEntry::make('api_domain'),
                TextEntry::make('token_type'),
                TextEntry::make('expires_in')
                    ->numeric(),
                TextEntry::make('expires_at')
                    ->dateTime(),
            ]);
    }
}
