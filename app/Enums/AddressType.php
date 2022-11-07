<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum AddressType: string
{
    use EnumToArray;

    case PROFESSIONAL = 'Professionnel';
    case PERSONAL = 'Personnel';
}
