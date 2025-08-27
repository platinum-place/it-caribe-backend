<?php

namespace App\Enums\CRM;

enum LeadTypeEnum:int
{
    case PUBLIC = 1;

    case PRIVATE = 2;

    case SELF_EMPLOYED = 3;
}
