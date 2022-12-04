<?php

namespace App\Enums;

use App\Settings\PricingSettings;
use Illuminate\Support\Facades\App;

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

    public function price(): string
    {
        $pricing = App::make(PricingSettings::class);

        return match($this)
        {
            self::SIMPLE_LETTER => $pricing->simple_letter,
            self::FOLLOWED_LETTER => $pricing->followed_letter,
            self::REGISTERED_LETTER => $pricing->registered_letter,
        };
    }
}
