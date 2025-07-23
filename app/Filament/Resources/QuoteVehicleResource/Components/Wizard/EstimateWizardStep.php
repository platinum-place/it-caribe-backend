<?php

namespace App\Filament\Resources\QuoteVehicleResource\Components\Wizard;

use App\Filament\Resources\QuoteVehicleResource\Components\Forms\EstimateVehicleForm;
use App\Models\VehicleType;
use App\Services\EstimateQuoteVehicle;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Support\RawJs;

class EstimateWizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('Estimate'))
            ->schema([
                EstimateVehicleForm::make(),

                Actions::make([
                    Action::make('generateEstimate')
                        ->translateLabel()
                        ->action(function (Set $set, Get $get) {
                            $estimates = app(EstimateQuoteVehicle::class)->estimate(
                                $get('vehicle_amount'),
                                $get('vehicle_year'),
                                $get('vehicle_type_id'),
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
                    ->schema([
                        TextInput::make('name')
                            ->label('Aseguradora')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('vehicle_rate')
                            ->label('Tasa')
                            ->disabled()
                            ->dehydrated(false)
                            ->numeric(),

                        TextInput::make('total')
                            ->label('Total anual')
                            ->disabled()
                            ->dehydrated(false)
                            ->prefix('RD$')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric(),

                        TextInput::make('total_monthly')
                            ->label('Total mensual')
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
                    ->columns(4)
                    ->deletable(false)
                    ->reorderable(false)
                    ->addable(false)
                    ->columnSpanFull(),
            ])
            ->columns();
    }
}
