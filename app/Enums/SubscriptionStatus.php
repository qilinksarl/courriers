<?php

namespace App\Enums;

enum SubscriptionStatus: string
{
    case TRIAL = 'TRIAL';
    case CANCEL_REQUEST = 'CANCEL_REQUEST';
    case CANCELED = 'CANCELED';
    case RECURRING = 'RECURRING';

    public function label(): string
    {
        return match($this)
        {
            self::TRIAL => 'Essais',
            self::CANCEL_REQUEST => 'Demande de désabonnement',
            self::CANCELED => 'Désabonné',
            self::RECURRING => 'Récurrent',
        };
    }
}
