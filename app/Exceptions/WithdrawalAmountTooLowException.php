<?php

namespace App\Exceptions;

use Exception;

class WithdrawalAmountTooLowException extends Exception
{
    public function __construct($amount)
    {
        parent::__construct("Withdrawal amount must be greater or equal to than: ". $amount);
    }
}
