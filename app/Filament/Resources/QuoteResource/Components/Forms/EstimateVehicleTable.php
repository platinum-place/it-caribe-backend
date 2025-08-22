<?php

namespace App\Filament\Resources\QuoteResource\Components\Forms;

use App\Services\EstimateQuoteVehicleService;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Support\RawJs;

class EstimateVehicleTable
{
    public static function make(): Grid
    {
        return Grid::make()
            ->schema([
                Actions::make([
                    Action::make('generateEstimate')
                        ->translateLabel()
                        ->action(function (Set $set, Get $get) {
                            $estimates = app(EstimateQuoteVehicleService::class)->estimate(
                                $get('vehicle_amount'),
                                $get('vehicle_make_id'),
                                $get('vehicle_model_id'),
                                $get('vehicle_year'),
                                $get('vehicle_type_id'),
                                $get('is_employee'),
                                $get('leasing'),
                                $get('service_type'),
                            );

                            dd('estimates_table', $estimates);
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
                            ->dehydrated(false)
                            ->columnSpan(2),

//                        TextInput::make('vehicle_rate')
//                            ->label('Tasa')
//                            ->disabled()
//                            ->dehydrated(false)
//                            ->numeric()
//                            ->columnSpan(1),

//                        TextInput::make('total')
//                            ->label('Total anual')
//                            ->disabled()
//                            ->dehydrated(false)
//                            ->prefix('RD$')
//                            ->mask(RawJs::make('$money($input)'))
//                            ->stripCharacters(',')
//                            ->numeric()
//                            ->columnSpan(1),

                        TextInput::make('total_monthly')
                            ->label('Total mensual')
                            ->disabled()
                            ->dehydrated(false)
                            ->prefix('RD$')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->columnSpan(1),

                        TextInput::make('error')
                            ->label('Comentario')
                            ->disabled()
                            ->dehydrated(false)
                            ->columnSpanFull(),
                    ])
                    ->columns(5)
                    ->deletable(false)
                    ->reorderable(false)
                    ->addable(false)
                    ->columnSpanFull(),
            ]);
    }
}
