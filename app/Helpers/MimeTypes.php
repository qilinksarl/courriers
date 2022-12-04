<?php

namespace App\Helpers;

class MimeTypes
{
    /**
     * @return string
     */
    public static function authorized(): string
    {
        return implode(',', [
            'application/pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/msword',
            'text/plain'
        ]);
    }
}
