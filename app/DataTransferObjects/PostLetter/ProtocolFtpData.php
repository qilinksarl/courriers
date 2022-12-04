<?php

namespace App\DataTransferObjects\PostLetter;

use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Data;

class ProtocolFtpData extends Data
{
    /**
     * @param string|null $login
     * @param string|null $folder
     */
    public function __construct(
        #[Nullable]
        public ?string $login = null,
        #[Nullable]
        public ?string $folder = null,
    ){
    }
}
