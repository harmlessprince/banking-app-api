<?php

namespace App\Exceptions;

use Exception;

class InvalidPinLengthException extends Exception
{
    public function __construct()
    {
        parent::__construct("Length of pin must be equal to 4");
    }
}
