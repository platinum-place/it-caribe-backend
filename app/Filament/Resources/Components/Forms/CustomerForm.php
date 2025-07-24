<?php

namespace App\Filament\Resources\Components\Forms;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;

class CustomerForm
{
    public static function make(): Grid
    {
        return Grid::make()
            ->schema([
                TextInput::make('first_name')
                    ->translateLabel()
                    ->required(),
                TextInput::make('last_name')
                    ->translateLabel()
                    ->required(),
                TextInput::make('identity_number')
                    ->translateLabel()
                    ->required(),

                DatePicker::make('birth_date')
                    ->translateLabel()
                    ->required(),

                Hidden::make('age'),

                TextInput::make('email')
                    ->translateLabel()
                    ->email(),
                TextInput::make('mobile_phone')
                    ->translateLabel()
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('home_phone')
                    ->translateLabel()
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('work_phone')
                    ->translateLabel()
                    ->tel()
                    ->mask('999-999-9999'),
                TextInput::make('address')
                    ->translateLabel()
                    ->columnSpanFull(),
            ]);
    }
}
