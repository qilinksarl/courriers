<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum AppType: string
{
    use EnumToArray;

    case TERMINATION_LETTER = 'termination-letter';
    case REGISTERED_LETTER = 'registered-letter';
    case POST_OFFICE = 'post-office';
}
