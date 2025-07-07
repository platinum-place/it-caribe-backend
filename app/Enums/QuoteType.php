<?php

namespace App\Enums;

enum QuoteType: int
{
    case FIRE = 0;

    case AUTO = 1;

    case UNEMPLOYMENT = 2;

    case DEBT_UNEMPLOYMENT = 3;

    case LIFE = 4;

    case AUTO_LAW = 5;
}
