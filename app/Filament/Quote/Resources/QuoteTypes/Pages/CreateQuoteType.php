<?php

namespace App\Filament\Quote\Resources\QuoteTypes\Pages;

use App\Filament\Quote\Resources\QuoteTypes\QuoteTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuoteType extends CreateRecord
{
    protected static string $resource = QuoteTypeResource::class;
}
