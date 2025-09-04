<?php

namespace Modules\Domain\Quotations\Core\Enums;

enum QuoteLineStatusEnum: int
{
    case NOT_ACCEPTED = 1;

    case ACCEPTED = 2;
}
