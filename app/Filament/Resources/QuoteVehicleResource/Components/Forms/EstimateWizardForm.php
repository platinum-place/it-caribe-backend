<?php

namespace App\Filament\Resources\QuoteVehicleResource\Components\Forms;

use App\Helpers\Cotizacion;
use App\Helpers\Cotizaciones;
use App\Helpers\CotizarAuto;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use App\Models\VehicleUse;
use App\Services\EstimateQuoteVehicle;
use App\Services\ZohoCRMService;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Support\RawJs;

class EstimateWizardForm
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
                            $vehicleType = VehicleType::find($get('vehicle_type_id'));

                            $estimate = app(EstimateQuoteVehicle::class)->estimate(
                                $get('vehicle_amount'),
                                $get('vehicle_year'),
                                $vehicleType,
                            );

                            $set('estimate', $estimate);
                        })
                        ->color('primary')
                        ->icon('heroicon-o-calculator'),
                ])
                    ->columnSpanFull(),

                Repeater::make('estimate')
                    ->hiddenLabel()
                    ->schema([
                        TextInput::make('name')
                            ->label('Aseguradora')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('insurance_rate')
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
