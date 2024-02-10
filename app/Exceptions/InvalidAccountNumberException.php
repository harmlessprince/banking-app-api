<?php

namespace App\Exceptions;

class InvalidAccountNumberException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Invalid Account Number");

    }
}
