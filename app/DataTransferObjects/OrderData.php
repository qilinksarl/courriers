<?php

namespace App\DataTransferObjects;

use App\Enums\PostageType;
use Spatie\LaravelData\Data;

class OrderData extends Data
{
    /**
     * @param PostageType $postage
     */
    public function __construct(
        public PostageType $postage,
    ){
    }
}
