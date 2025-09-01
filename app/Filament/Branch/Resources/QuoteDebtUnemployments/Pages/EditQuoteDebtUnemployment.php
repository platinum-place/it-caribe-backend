<?php

namespace App\Filament\Branch\Resources\QuoteDebtUnemployments\Pages;

use App\Filament\Branch\Resources\QuoteDebtUnemployments\QuoteDebtUnemploymentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditQuoteDebtUnemployment extends EditRecord
{
    protected static string $resource = QuoteDebtUnemploymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
