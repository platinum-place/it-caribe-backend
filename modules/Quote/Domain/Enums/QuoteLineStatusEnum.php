<?php

namespace Modules\Quote\Domain\Enums;

enum QuoteLineStatusEnum: int
{
    case NOT_ACCEPTED = 1;

    case ACCEPTED = 2;
}
