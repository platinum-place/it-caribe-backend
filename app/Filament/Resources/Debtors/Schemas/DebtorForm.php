<?php

namespace App\Filament\Resources\Debtors\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DebtorForm
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
                Toggle::make('age')
                    ->required(),
                TextInput::make('debtor_type_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
