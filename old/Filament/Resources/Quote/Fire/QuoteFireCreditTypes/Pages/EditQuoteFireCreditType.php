<?php

namespace App\Filament\Resources\Quote\Fire\QuoteFireCreditTypes\Pages;

use old\Filament\Resources\Quote\Fire\QuoteFireCreditTypes\QuoteFireCreditTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditQuoteFireCreditType extends EditRecord
{
    protected static string $resource = QuoteFireCreditTypeResource::class;

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
