<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteResource;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;
}
