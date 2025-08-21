<?php

namespace App\forlder;

enum QuoteUnemploymentDebtorType: int
{
    case ONETIME_PAYMENT = 1;

    case MONTHLY = 2;
}
