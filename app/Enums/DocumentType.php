<?php

namespace App\Enums;

enum DocumentType: string
{
    case JPG = 'JPG';
    case PDF = 'PDF';
    case TEMPLATE = 'TEMPLATE';
    case TXT = 'TXT';
    case WORD = 'WORD';

    public function label(): string
    {
        return match($this)
        {
            self::JPG => 'Jpg',
            self::PDF => 'Pdf',
            self::TEMPLATE => 'Pdf',
            self::TXT => 'Text',
            self::WORD => 'Word',
        };
    }
}
