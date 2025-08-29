<?php

namespace App\Filament\Resources\CRM\Leads\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LeadForm
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
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('first_name'),
                TextInput::make('last_name'),
                TextInput::make('identity_number'),
                DatePicker::make('birth_date'),
                TextInput::make('home_phone')
                    ->tel(),
                TextInput::make('mobile_phone')
                    ->tel(),
                TextInput::make('work_phone')
                    ->tel(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('is_employee')
                    ->numeric(),
                TextInput::make('age')
                    ->numeric(),
                TextInput::make('lead_type_id')
                    ->numeric(),
            ]);
    }
}
