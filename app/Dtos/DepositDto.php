<?php

namespace App\Dtos;

use App\Enum\TransactionCategoryEnum;

class DepositDto
{
    private string $account_number; // receivers account number
    private int|float $amount;
    private   string|null $description;

    private  string $category;

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->account_number;
    }

    /**
     * @param string $account_number
     */
    public function setAccountNumber(string $account_number): void
    {
        $this->account_number = $account_number;
    }

    /**
     * @return float|int
     */
    public function getAmount(): float|int
    {
        return $this->amount;
    }

    /**
     * @param float|int $amount
     */
    public function setAmount(float|int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        $this->setCategory(TransactionCategoryEnum::WITHDRAWAL->value);
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }



}
