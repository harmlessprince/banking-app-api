<?php

namespace App\Http\Controllers;

use App\Dtos\DepositDto;
use App\Dtos\WithdrawDto;
use App\Exceptions\ANotFoundException;
use App\Exceptions\DepositAmountToLowException;
use App\Exceptions\InvalidAccountNumberException;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\WithdrawRequest;
use App\Services\AccountService;
use Illuminate\Http\Request;

class AccountWithdrawalController extends Controller
{
    public function __construct(private readonly AccountService $accountService)
    {
    }

    /**
     * @throws InvalidAccountNumberException
     * @throws ANotFoundException
     */
    public function store(WithdrawRequest $request)
    {
        $account = $this->accountService->getAccountByUserID($request->user()->id);
        $withdrawDto = new WithdrawDto();
        $withdrawDto->setAccountNumber($account->account_number);
        $withdrawDto->setAmount($request->input('amount'));
        $withdrawDto->setDescription($request->input('description'));
        $withdrawDto->setPin($request->input('pin'));
        $this->accountService->withdraw($withdrawDto);
        return $this->sendSuccess([], 'Withdrawal successful');
    }
}
