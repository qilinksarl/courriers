<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;

class OptionData extends Data
{
    /**
     * @param string $name
     * @param float $price
     */
    public function __construct(
        public string $name,
        public float $price,
    ){
    }
}
