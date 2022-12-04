<?php

namespace App\Helpers;

use App\Settings\AccountingSettings;
use Illuminate\Support\Facades\App;

class Accounting
{
    /**
     * @param float $value
     * @return float
     */
    public static function addTax(float $value): float
    {
        return $value * (1 + App::make(AccountingSettings::class)->vat_rate / 100);
    }
}
