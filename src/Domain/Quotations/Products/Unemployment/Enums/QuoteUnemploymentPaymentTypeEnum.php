<?php

namespace Modules\Domain\Quotations\Products\Unemployment\Enums;

enum QuoteUnemploymentPaymentTypeEnum: int
{
    case ONETIME_PAYMENT = 1;

    case MONTHLY = 2;
}
