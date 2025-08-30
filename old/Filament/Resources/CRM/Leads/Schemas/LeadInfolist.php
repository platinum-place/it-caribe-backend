<?php

namespace App\Filament\Resources\CRM\Leads\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LeadInfolist
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
                TextEntry::make('full_name'),
                TextEntry::make('first_name'),
                TextEntry::make('last_name'),
                TextEntry::make('identity_number'),
                TextEntry::make('birth_date')
                    ->date(),
                TextEntry::make('home_phone'),
                TextEntry::make('mobile_phone'),
                TextEntry::make('work_phone'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('is_employee')
                    ->numeric(),
                TextEntry::make('age')
                    ->numeric(),
                TextEntry::make('lead_type_id')
                    ->numeric(),
            ]);
    }
}
