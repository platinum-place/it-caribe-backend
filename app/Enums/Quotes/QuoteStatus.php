<?php

namespace App\Enums\Quotes;

enum QuoteStatus: int
{
    case PENDING = 1;

    case APPROVED = 2;

    case REJECTED = 3;

    case CANCELLED = 4;

    case EXPIRED = 5;
}
