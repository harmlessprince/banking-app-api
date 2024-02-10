<?php

namespace App\Exceptions;

class DepositAmountToLowException extends \Exception
{
    public function __construct($amount)
    {
        parent::__construct("Deposit amount must be greater than: ". $amount);
    }
}
