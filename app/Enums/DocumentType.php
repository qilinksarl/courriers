<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum DocumentType: string
{
    use EnumToArray;

    case JPG = 'JPG';
    case PDF = 'PDF';
    case TXT = 'TXT';
    case WORD = 'WORD';
}
