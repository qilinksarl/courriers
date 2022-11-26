<?php

namespace App\Enums;

enum DocumentType: string
{
    case JPG = 'JPG';
    case PDF = 'PDF';
    case TXT = 'TXT';
    case WORD = 'WORD';
}
