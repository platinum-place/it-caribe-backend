<?php

namespace Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLifeCreditTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLifeCreditTypes\QuoteLifeCreditTypeResource;

class ManageQuoteLifeCreditTypes extends ManageRecords
{
    protected static string $resource = QuoteLifeCreditTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
