<?php

namespace Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFireCreditTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFireCreditTypes\QuoteFireCreditTypeResource;

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
