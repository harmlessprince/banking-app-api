<?php

namespace App\Interfaces;

use App\Dtos\UserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface UserServiceInterface
{
    public function  createUser(UserDto $userDto): Builder|Model;
    public function  getUserById(int $userId): Builder|Model;
    public function  setupPin(User $user, string $pin): void;

    public function  validatePin(int $userId, string $pin): bool;
    public function  hasSetPin(User $user): bool;

}
