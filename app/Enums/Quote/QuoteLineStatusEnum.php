<?php

namespace App\Enums\Quote;

enum QuoteLineStatusEnum: int
{
    case NOT_ACCEPTED = 1;

    case ACCEPTED = 2;
}
