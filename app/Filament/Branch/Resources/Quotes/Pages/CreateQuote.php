<?php

namespace App\Filament\Branch\Resources\Quotes\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Branch\Resources\Quotes\QuoteResource;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;
}
