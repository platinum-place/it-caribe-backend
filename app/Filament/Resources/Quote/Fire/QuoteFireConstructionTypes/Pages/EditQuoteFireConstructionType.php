<?php

namespace App\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes\Pages;

use App\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes\QuoteFireConstructionTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditQuoteFireConstructionType extends EditRecord
{
    protected static string $resource = QuoteFireConstructionTypeResource::class;

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
