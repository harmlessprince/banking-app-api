<?php

namespace App\Exceptions;

class InvalidPinException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Pin is invalid");
    }
}
