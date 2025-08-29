<?php

namespace App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes\Pages;

use App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes\QuoteFireRiskTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditQuoteFireRiskType extends EditRecord
{
    protected static string $resource = QuoteFireRiskTypeResource::class;

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
