<?php

namespace App\DataTransferObjects\PostLetter;

use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class ProtocolData extends Data
{
    /**
     * @param ProtocolFtpData $protocol
     */
    public function __construct(
        #[Required]
        public ProtocolFtpData $protocol,
    ){
    }
}
