<?php

namespace App\Filament\Resources\Quote\QuoteStatuses\Pages;

use App\Filament\Resources\Quote\QuoteStatuses\QuoteStatusResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuoteStatus extends CreateRecord
{
    protected static string $resource = QuoteStatusResource::class;
}
