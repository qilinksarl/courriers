<?php

namespace App\Enums;

enum PostageType: string
{
    case SIMPLE_LETTER = 'SIMPLE_LETTER';
    case FOLLOWED_LETTER = 'FOLLOWED_LETTER';
    case REGISTERED_LETTER = 'REGISTERED_LETTER';

    public function label(): string
    {
        return match($this)
        {
            self::SIMPLE_LETTER => 'Lettre simple',
            self::FOLLOWED_LETTER => 'Lettre suivie',
            self::REGISTERED_LETTER => 'Lettre recommandée',
        };
    }
}
