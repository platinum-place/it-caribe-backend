<?php

namespace App\Filament\Branch\Resources\Quotes\Pages;

use App\Filament\Branch\Resources\Quotes\QuoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;
}
