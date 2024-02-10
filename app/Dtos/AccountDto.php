<?php

namespace App\Dtos;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AccountDto
{
    private int $id;
    private int $user_id;
    private string $account_number;
    private  float $balance;

    private  Carbon $created_at;

    private  Carbon $updated_at;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AccountDto
     */
    public function setId(int $id): AccountDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return AccountDto
     */
    public function setUserId(int $user_id): AccountDto
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->account_number;
    }

    /**
     * @param string $account_number
     * @return AccountDto
     */
    public function setAccountNumber(string $account_number): AccountDto
    {
        $this->account_number = $account_number;
        return $this;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     * @return AccountDto
     */
    public function setBalance(float $balance): AccountDto
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    /**
     * @param Carbon $created_at
     * @return AccountDto
     */
    public function setCreatedAt(Carbon $created_at): AccountDto
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    /**
     * @param Carbon $updated_at
     * @return AccountDto
     */
    public function setUpdatedAt(Carbon $updated_at): AccountDto
    {
        $this->updated_at = $updated_at;
        return $this;
    }


    public static function fromModel(Account $account): self
    {
        $dto = new self();
        $dto->setId($account->id)
            ->setUserId($account->user_id)
            ->setAccountNumber($account->account_number)
            ->setBalance($account->balance);
        return $dto;
    }


}
