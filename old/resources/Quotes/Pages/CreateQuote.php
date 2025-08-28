<?php

namespace old\Resources\Quotes\Pages;

use Filament\Resources\Pages\CreateRecord;
use old\Resources\Quotes\QuoteResource;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;
}
