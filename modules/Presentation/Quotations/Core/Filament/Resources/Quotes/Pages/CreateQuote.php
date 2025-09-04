<?php

namespace Modules\Presentation\Quotations\Core\Filament\Resources\Quotes\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Presentation\Quotations\Core\Filament\Resources\Quotes\QuoteResource;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;
}
