<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\QuoteStatusResource;

class CreateQuoteStatus extends CreateRecord
{
    protected static string $resource = QuoteStatusResource::class;
}
