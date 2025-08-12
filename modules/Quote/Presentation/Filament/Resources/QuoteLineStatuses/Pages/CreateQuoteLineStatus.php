<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses\QuoteLineStatusResource;

class CreateQuoteLineStatus extends CreateRecord
{
    protected static string $resource = QuoteLineStatusResource::class;
}
