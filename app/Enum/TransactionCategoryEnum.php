<?php

namespace App\Enum;

enum TransactionCategoryEnum: string
{
    case  WITHDRAWAL = 'withdrawal';
    case DEPOSIT = 'deposit';
}
