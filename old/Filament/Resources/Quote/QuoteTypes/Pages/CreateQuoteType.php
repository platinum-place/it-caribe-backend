<?php

namespace App\Filament\Resources\Quote\QuoteTypes\Pages;

use old\Filament\Resources\Quote\QuoteTypes\QuoteTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuoteType extends CreateRecord
{
    protected static string $resource = QuoteTypeResource::class;
}
