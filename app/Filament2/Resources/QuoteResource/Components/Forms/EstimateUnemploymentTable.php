<?php

namespace App\Filament\Resources\QuoteResource\Components\Forms;

use App\Services\EstimateQuoteUnemploymentService;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Support\RawJs;

class EstimateUnemploymentTable
{
    public static function make(): Grid
    {
        return Grid::make()
            ->schema([
                Actions::make([
                    Action::make('generateEstimate')
                        ->translateLabel()
                        ->action(function (Set $set, Get $get) {
                            $estimates = app(EstimateQuoteUnemploymentService::class)->estimate(
                                $get('birth_date'),
                                $get('loan_installment'),
                                $get('deadline'),
                                $get('quote_unemployment_debtor_type_id'),
                                $get('quote_unemployment_use_type_id'),
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

                        TextInput::make('rate')
                            ->label('Tasa')
                            ->disabled()
                            ->dehydrated(false)
                            ->numeric(),

                        TextInput::make('total')
                            ->label('Total')
                            ->disabled()
                            ->dehydrated(false)
                            ->prefix('RD$')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric(),

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
