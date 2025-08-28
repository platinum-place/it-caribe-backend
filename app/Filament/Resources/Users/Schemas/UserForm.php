<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live(true)
                    ->afterStateUpdated(function ($state, Set $set) {
                        return $set('username', str_replace(' ', '.', strtolower($state)));
                    }),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->default(Str::random())
                    ->required()
                    ->password()
                    ->revealable()
                    ->copyable()
                    ->visibleOn('create'),
                TextInput::make('username'),
            ]);
    }
}
