<?php

namespace App\Filament\Resources\QuoteFireResource\Pages;

use App\Filament\Resources\QuoteFireResource;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateQuoteFire extends CreateRecord
{
    protected static string $resource = QuoteFireResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    QuoteFireResource\Components\Wizard\EstimateWizardStep::make(),
                    //                    QuoteFireResource\Components\Wizard\DebtorWizardStep::make(),
                    //                    QuoteFireResource\Components\Wizard\CoDebtorWizardStep::make()
                    //                        ->hidden(fn ($get) => ! $get('co_debtor_birth_date')),
                ])
                    ->columnSpanFull(),
            ]);
    }
}
