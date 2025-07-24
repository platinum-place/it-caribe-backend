<?php

namespace App\Filament\Resources\QuoteFireResource\Components\Wizard;

use App\Filament\Resources\Components\Forms\CustomerForm;
use Filament\Forms\Components\Wizard;

class DebtorWizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('Debtor'))
            ->schema([
                CustomerForm::make(),
            ])
            ->columns();
    }
}
