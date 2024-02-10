<?php

namespace App\Http\Controllers;

use App\Exceptions\ANotFoundException;
use App\Http\Requests\TransferRequest;
use App\Services\AccountService;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function __construct(private readonly AccountService $accountService)
    {
    }

    /**
     * @throws ANotFoundException
     * @throws \Exception
     */
    public function store(TransferRequest $request)
    {
        $user = $request->user();
        $senderAccount = $this->accountService->getAccountByUserID($user->id);

        $transferDto = $this->accountService->transfer(
            $senderAccount->account_number,
            $request->input('receiver_account_number'),
            $request->input('pin'),
            $request->input('amount'),
            $request->input('description'),
        );

        return $this->sendSuccess([], 'Account Transfer In Progress');
    }
}
