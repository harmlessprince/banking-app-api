<?php

namespace App\Services;

use App\Dtos\UserDto;
use App\Exceptions\InvalidPinLengthException;
use App\Exceptions\PinHasAlreadyBeenSetException;
use App\Exceptions\PinNotSetException;
use App\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserService implements UserServiceInterface
{
    public function createUser(UserDto $userDto): Builder|Model
    {
        return User::query()->create([
            'name' => $userDto->getName(),
            'email' => $userDto->getEmail(),
            'password' => $userDto->getPassword(),
            'phone_number' => $userDto->getPhoneNumber(),
        ]);
    }


    /**
     * @param User $user
     * @param string $pin
     * @return void
     * @throws InvalidPinLengthException
     * @throws PinHasAlreadyBeenSetException
     */
    public function setupPin(User $user, string $pin): void
    {
        if ($this->hasSetPin($user)) {
            throw new PinHasAlreadyBeenSetException("Pin has already been set");
        }
        if (strlen($pin) != 4) {
            throw new InvalidPinLengthException();
        }
        $user->pin = Hash::make($pin);
        $user->save();
    }

    /**
     * @param string $pin
     * @return bool
     * @throws PinNotSetException
     */
    public function validatePin(int $userId, string $pin): bool
    {

        $user = $this->getUserById($userId);
        if (!$this->hasSetPin($user)) {
            throw new PinNotSetException("Please set your pin");
        }
        return Hash::check($pin, $user->pin);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function hasSetPin(User $user): bool
    {
        return $user->pin != null;
    }



    /**
     * @param int $userId
     * @return Builder|Model
     */
    public function getUserById(int $userId): Builder|Model
    {
        $user = User::query()->where('id', $userId)->first();
        if (!$user) {
            throw new ModelNotFoundException("User not found");
        }
        return $user;
    }
}
