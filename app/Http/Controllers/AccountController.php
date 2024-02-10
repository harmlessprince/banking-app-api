<?php

namespace App\Http\Controllers;

use App\Dtos\UserDto;
use App\Services\AccountService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //PHP 8.1 above
    public function __construct(private readonly AccountService $accountService)
    {
    }

    //PHP 8.0  below
//    private AccountService $accountService;
//
//    public function __construct(AccountService $accountService)
//    {
//        $this->accountService = $accountService;
//    }

    public function store(Request $request)
    {
        $userDto = UserDto::fromModel($request->user());
        $account = $this->accountService->createAccountNumber($userDto);
        return $this->sendSuccess(['acccount' => $account], 'Account number generated successfully');
    }
}
