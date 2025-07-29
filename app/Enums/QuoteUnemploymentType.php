<?php

namespace App\Enums;

enum QuoteUnemploymentType: int
{
    case OnetimePayment = 1;

    case VEHICLE = 2;

    case UNEMPLOYMENT = 3;

    case DEBT_UNEMPLOYMENT = 4;

    case LIFE = 5;

    case VEHICLE_LAW = 6;
}
