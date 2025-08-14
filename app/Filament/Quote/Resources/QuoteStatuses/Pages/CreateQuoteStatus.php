<?php

namespace App\Filament\Quote\Resources\QuoteStatuses\Pages;

use App\Filament\Quote\Resources\QuoteStatuses\QuoteStatusResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuoteStatus extends CreateRecord
{
    protected static string $resource = QuoteStatusResource::class;
}
