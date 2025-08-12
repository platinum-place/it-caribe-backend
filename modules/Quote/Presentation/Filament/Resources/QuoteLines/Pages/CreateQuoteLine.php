<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteLines\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteLines\QuoteLineResource;

class CreateQuoteLine extends CreateRecord
{
    protected static string $resource = QuoteLineResource::class;
}
