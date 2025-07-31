<?php

namespace App\Enums;

enum QuoteUnemploymentDebtorType: int
{
    case ONETIME_PAYMENT = 1;

    case MONTHLY = 2;
}
