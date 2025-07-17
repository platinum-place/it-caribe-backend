<?php

namespace App\Filament\Resources\Quotes\QuoteVehicleResource\Components\Forms;

use App\Helpers\Cotizacion;
use App\Helpers\Cotizaciones;
use App\Helpers\CotizarAuto;
use App\Models\Vehicles\VehicleMake;
use App\Models\Vehicles\VehicleModel;
use App\Models\Vehicles\VehicleUse;
use App\Services\Quotes\EstimateQuoteVehicle;
use App\Services\ZohoCRMService;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Get;
use Filament\Forms\Set;

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
                            $set('planes', null);
                            $set('vehicle_type_id', null);
                            $set('cotizacion', null);

//                            $estimate = app(EstimateQuoteVehicle::class)->estimate(
//                                $get('vehicle_amount'),
//                                $get('vehicle_year')
//                            );
//
//                            dd($estimate);

                            $libreria = new Cotizaciones;

                            $cotizacion = new Cotizacion;

                            $cotizacion->suma = $get('vehicle_amount');

                            $cotizacion->plan = $get('plan');
                            $cotizacion->ano = $get('vehicle_year');
                            $cotizacion->uso = VehicleUse::find($get('vehicle_use_id'))->description;
                            $cotizacion->estado = $get('estado');
                            $cotizacion->tipo_pago = $get('tipo');
                            $cotizacion->tipo_equipo = $get('tipo_equipo');

                            $model = VehicleModel::find($get('vehicle_model_id'));

                            $criteria = 'Name:equals:'.VehicleMake::find($get('vehicle_make_id'))->name;
                            $vehicleMake = app(ZohoCRMService::class)->searchRecords('Marcas', $criteria);

                            $criteria = 'Name:equals:'.$model->name;
                            $vehicleModel = app(ZohoCRMService::class)->searchRecords('Modelos', $criteria);

                            $cotizacion->marcaid = $vehicleMake['data'][0]['id'];
                            $cotizacion->modeloid = $vehicleModel['data'][0]['id'];
                            $cotizacion->modelotipo = $model->type->name;

                            $cotizar = new CotizarAuto($cotizacion, $libreria);

                            $cotizar->cotizar_planes();

                            $results = $cotizacion->planes;

                            $set('planes', $results);
                            $set('vehicle_type_id', $model->vehicle_type_id);
                            $set('cotizacion', json_decode(json_encode($cotizacion), true));
                        })
                        ->color('primary')
                        ->icon('heroicon-o-calculator'),
                ])
                    ->columnSpanFull(),

                Repeater::make('planes')
                    ->hiddenLabel()
                    ->schema([
                        TextInput::make('aseguradora')
                            ->label('Aseguradora')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('total')
                            ->label('Total')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('comentario')
                            ->label('Comentario')
                            ->disabled()
                            ->dehydrated(false),
                    ])
                    ->columns(3)
                    ->deletable(false)
                    ->reorderable(false)
                    ->addable(false)
                    ->columnSpanFull(),

                Hidden::make('cotizacion'),
            ])
            ->columns();
    }
}
