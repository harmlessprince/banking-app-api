<?php

namespace App\Http\Controllers;

use App\Dtos\DepositDto;
use App\Exceptions\DepositAmountToLowException;
use App\Exceptions\InvalidAccountNumberException;
use App\Http\Requests\DepositRequest;
use App\Services\AccountService;
use Illuminate\Http\Request;

class AccountDepositController extends Controller
{
    public function __construct(private readonly AccountService $accountService)
    {
    }

    /**
     * @throws InvalidAccountNumberException
     * @throws DepositAmountToLowException
     */
    public function store(DepositRequest $request)
    {
        $depositDto = new DepositDto();
        $depositDto->setAccountNumber($request->input('account_number'));
        $depositDto->setAmount($request->input('amount'));
        $depositDto->setDescription($request->input('description'));
        $this->accountService->deposit($depositDto);
        return $this->sendSuccess([], 'Deposit successful');
    }
}
