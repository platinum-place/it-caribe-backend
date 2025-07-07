<?php

namespace App\Enums;

enum QuoteStatus: int
{
    case PENDING = 0;

    case APPROVED = 1;

    case REJECTED = 2;

    case CANCELLED = 3;

    case EXPIRED = 4;

    case UNDER_REVIEW = 5;

    case COMPLETED = 6;
}
