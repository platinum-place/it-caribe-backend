<?php

namespace Modules\Quote\Enums;

enum QuoteLineStatusEnum: int
{
    case NOT_ACCEPTED = 1;

    case ACCEPTED = 2;
}
