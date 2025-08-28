<?php

namespace App\Enums\Quote\Unemployment;

enum QuoteUnemploymentPaymentTypeEnum: int
{
    case ONETIME_PAYMENT = 1;

    case MONTHLY = 2;
}
