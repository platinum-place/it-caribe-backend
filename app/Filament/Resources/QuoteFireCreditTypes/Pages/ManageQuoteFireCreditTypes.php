<?php

namespace App\Filament\Resources\QuoteFireCreditTypes\Pages;

use App\Filament\Resources\QuoteFireCreditTypes\QuoteFireCreditTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageQuoteFireCreditTypes extends ManageRecords
{
    protected static string $resource = QuoteFireCreditTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
