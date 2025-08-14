<?php

namespace App\Filament\Quote\Resources\Quotes\Pages;

use App\Filament\Quote\Resources\Quotes\QuoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;
}
