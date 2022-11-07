<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PostageType: string
{
    use EnumToArray;

    case SIMPLE_LETTER = 'simple-letter';
    case FOLLOWED_LETTER = 'followed-letter';
    case REGISTERED_LETTER = 'registered-letter';
}
