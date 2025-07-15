<?php

namespace App\Enums\Quotes;

enum QuoteLineStatus: int
{
    case NOT_ACCEPTED = 1;

    case ACCEPTED = 2;
}
