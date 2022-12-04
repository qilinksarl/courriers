<?php

namespace App\Contracts;

interface PostLetter
{
    /**
     * @return void
     */
    public function execute(): void;
}
