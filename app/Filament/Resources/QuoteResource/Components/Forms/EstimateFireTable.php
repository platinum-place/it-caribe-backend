<?php

namespace App\Filament\Resources\QuoteResource\Components\Forms;

use App\Services\EstimateQuoteFireService;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Support\RawJs;

class EstimateFireTable
{
    public static function make(): Grid
    {
        return Grid::make()
            ->schema([
                Actions::make([
                    Action::make('generateEstimate')
                        ->translateLabel()
                        ->action(function (Set $set, Get $get) {
                            $estimates = app(EstimateQuoteFireService::class)->estimate(
                                $get('age'),
                                $get('deadline'),
                                $get('property_value'),
                                $get('life_insurance') ? $get('loan_value') : null,
                                $get('co_debtor_age'),
                            );

                            $set('estimates_table', $estimates);
                            $set('estimates', $estimates);
                        })
                        ->color('primary')
                        ->icon('heroicon-o-calculator'),
                ])
                    ->columnSpanFull(),

                Hidden::make('estimates'),

                Repeater::make('estimates_table')
                    ->hiddenLabel()
                    ->hidden(fn (Get $get) => $get('estimates') === null)
                    ->schema([
                        TextInput::make('name')
                            ->label('Aseguradora')
                            ->disabled()
                            ->dehydrated(false),

                        Fieldset::make('Plan Vida')
                            ->columns(4)
                            ->schema([
                                TextInput::make('debtor_rate')
                                    ->label('Tasa deudor')
                                    ->disabled()
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric(),

                                TextInput::make('co_debtor_rate')
                                    ->label('Tasa codeudor')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric(),

                                TextInput::make('debtor_amount')
                                    ->label('Prima deudor')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->prefix('RD$')
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric(),

                                TextInput::make('co_debtor_amount')
                                    ->label('Prima codeudor')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->prefix('RD$')
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric(),
                            ]),

                        Fieldset::make('Plan Incendio')
                            ->schema([
                                TextInput::make('fire_rate')
                                    ->label('Tasa Incendio')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric(),
                            ]),

                        Fieldset::make('Total')
                            ->columns(3)
                            ->schema([
                                TextInput::make('life_amount')
                                    ->label('Prima Vida')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->prefix('RD$')
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric(),

                                TextInput::make('fire_amount')
                                    ->label('Prima Incendio')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->prefix('RD$')
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric(),

                                TextInput::make('total')
                                    ->label('Total')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->prefix('RD$')
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric(),
                            ]),

                        TextInput::make('error')
                            ->label('Comentario')
                            ->disabled()
                            ->dehydrated(false)
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->deletable(false)
                    ->reorderable(false)
                    ->addable(false)
                    ->columnSpanFull(),
            ]);
    }
}
