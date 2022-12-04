<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AccountingSettings extends Settings
{
    /**
     * @var int
     */
    public int $vat_rate;

    /**
     * @var int
     */
    public int $invoice_number;

    /**
     * @return string
     */
    public static function group(): string
    {
        return 'accounting';
    }
}
