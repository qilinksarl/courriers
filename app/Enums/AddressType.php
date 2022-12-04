<?php

namespace App\Enums;

enum AddressType: string
{
    case PROFESSIONAL = 'PROFESSIONAL';
    case PERSONAL = 'PERSONAL';

    public function maileva(): string
    {
        return match($this)
        {
            self::PROFESSIONAL => 'PROFESSIONAL',
            self::PERSONAL => 'INDIVIDUAL',
        };
    }

    public function label(): string
    {
        return match($this)
        {
            self::PROFESSIONAL => 'Adresse professionnelle',
            self::PERSONAL => 'Adresse personnelle',
        };
    }
}
