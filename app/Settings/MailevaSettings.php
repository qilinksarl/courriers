<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class MailevaSettings extends Settings
{
    /**
     * @var string
     */
    public string $version;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $media_type;


    /**
     * @return string
     */
    public static function group(): string
    {
        return 'maileva';
    }
}
