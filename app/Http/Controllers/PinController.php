<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidPinLengthException;
use App\Exceptions\PinHasAlreadyBeenSetException;
use App\Exceptions\PinNotSetException;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PinController extends Controller
{
    /**
     * @throws InvalidPinLengthException
     * @throws ValidationException
     * @throws PinHasAlreadyBeenSetException
     */
    public function setupPin(Request $request, UserService $userService): JsonResponse
    {
        $this->validate($request, [
            'pin' => ['required', 'string', 'min:4', 'max:4']
        ]);
        /** @var User $user */
        $user = $request->user();
        $userService->setupPin($user, $request->input('pin'));
        return $this->sendSuccess([], 'Pin is set successfully');
    }

    /**
     * @throws PinNotSetException
     * @throws ValidationException
     */
    public function validatePin(Request $request, UserService $userService): JsonResponse
    {
        $this->validate($request, [
            'pin' => ['required', 'string']
        ]);
        /** @var User $user */
        $user = $request->user();
        $isValid = $userService->validatePin($user->id, $request->input('pin'));
        return $this->sendSuccess(['is_valid' => $isValid], 'Pin Validation');
    }
}
