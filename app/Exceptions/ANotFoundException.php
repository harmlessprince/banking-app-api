<?php

namespace App\Exceptions;

class ANotFoundException extends \Exception
{
    public function __construct(string $message = "Not Found")
    {
        parent::__construct($message, 404);
    }
}
