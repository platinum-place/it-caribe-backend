<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteTypes\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteTypes\QuoteTypeResource;

class CreateQuoteType extends CreateRecord
{
    protected static string $resource = QuoteTypeResource::class;
}
