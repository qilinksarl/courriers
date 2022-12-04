<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PricingSettings extends Settings
{
    /**
     * @var float
     */
    public float $receipt;

    /**
     * @var float
     */
    public float $sms_notification;

    /**
     * @var float
     */
    public float $simple_letter;

    /**
     * @var float
     */
    public float $followed_letter;

    /**
     * @var float
     */
    public float $registered_letter;

    /**
     * @var float
     */
    public float $black_print;

    /**
     * @var float
     */
    public float $color_print;

    /**
     * @var float
     */
    public float $recto_verso;

    /**
     * @return string
     */
    public static function group(): string
    {
        return 'pricing';
    }
}
