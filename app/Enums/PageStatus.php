<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PageStatus: string
{
    use EnumToArray;

    case DRAFT = 'Brouillon';
    case HIDDEN = 'Inaccessible';
    case VISIBLE = 'Accessible';
}
