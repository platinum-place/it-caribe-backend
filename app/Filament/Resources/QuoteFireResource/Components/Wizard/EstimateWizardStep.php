<?php

namespace App\Filament\Resources\QuoteFireResource\Components\Wizard;

use App\Filament\Resources\QuoteFireResource\Components\Forms\EstimateFireForm;
use App\Filament\Resources\QuoteLifeResource\Components\Forms\EstimateLifeForm;
use App\Services\EstimateQuoteLife;
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
                EstimateFireForm::make(),

                Actions::make([
                    Action::make('generateEstimate')
                        ->translateLabel()
                        ->action(function (Set $set, Get $get) {
                            $estimates = app(EstimateQuoteLife::class)->estimate(
                                $get('customer_age'),
                                $get('deadline'),
                                $get('insured_amount'),
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
            ])
            ->columns();
    }
}
