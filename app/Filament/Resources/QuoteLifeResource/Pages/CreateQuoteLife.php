<?php

namespace App\Filament\Resources\QuoteLifeResource\Pages;

use App\Filament\Resources\QuoteLifeResource;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateQuoteLife extends CreateRecord
{
    protected static string $resource = QuoteLifeResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    QuoteLifeResource\Components\Wizard\EstimateWizardStep::make(),
                    //                    \App\Filament\Resources\QuoteLifeResource\Components\Forms\CustomerWizardForm::make(),
                    //                    \App\Filament\Resources\QuoteLifeResource\Components\Forms\VehicleWizardForm::make(),
                ])
                    ->columnSpanFull(),
            ]);
    }
}
