<?php

namespace App\Dtos;

use App\Enum\TransactionCategoryEnum;
use Carbon\Carbon;

class TransactionDto
{
    private int|null $id;
    private string $reference;
    private int $user_id;
    private int $account_id;
    private int|null $transfer_id;
    private float $amount;
    private float $balance;
    private string $category;
    private string|null $description;

    private string|null $meta;

    private Carbon $date;
    private bool $confirmed;
    private Carbon $created_at;
    private Carbon $updated_at;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return TransactionDto
     */
    public function setId(int $id): TransactionDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return TransactionDto
     */
    public function setReference(string $reference): TransactionDto
    {
        $this->reference = $reference;
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
     * @return TransactionDto
     */
    public function setUserId(int $user_id): TransactionDto
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->account_id;
    }

    /**
     * @param int $account_id
     * @return TransactionDto
     */
    public function setAccountId(int $account_id): TransactionDto
    {
        $this->account_id = $account_id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTransferId(): ?int
    {
        return $this->transfer_id;
    }

    /**
     * @param int|null $transfer_id
     * @return TransactionDto
     */
    public function setTransferId(?int $transfer_id): TransactionDto
    {
        $this->transfer_id = $transfer_id;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return TransactionDto
     */
    public function setAmount(float $amount): TransactionDto
    {
        $this->amount = $amount;
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
     * @return TransactionDto
     */
    public function setBalance(float $balance): TransactionDto
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return TransactionDto
     */
    public function setCategory(string $category): TransactionDto
    {
        $this->category = $category;
        return $this;
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
     * @return TransactionDto
     */
    public function setDescription(?string $description): TransactionDto
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMeta(): ?string
    {
        return $this->meta;
    }

    /**
     * @param string|null $meta
     * @return TransactionDto
     */
    public function setMeta(?string $meta): TransactionDto
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @param Carbon $date
     * @return TransactionDto
     */
    public function setDate(Carbon $date): TransactionDto
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->confirmed;
    }

    /**
     * @param bool $confirmed
     * @return TransactionDto
     */
    public function setConfirmed(bool $confirmed): TransactionDto
    {
        $this->confirmed = $confirmed;
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
     * @return TransactionDto
     */
    public function setCreatedAt(Carbon $created_at): TransactionDto
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
     * @return TransactionDto
     */
    public function setUpdatedAt(Carbon $updated_at): TransactionDto
    {
        $this->updated_at = $updated_at;
        return $this;
    }


    public function forDeposit(AccountDto $accountDto, string $reference, float|int $amount, string|null $description): self
    {
        $dto = new TransactionDto();
        $dto->setUserId($accountDto->getUserId())
            ->setReference($reference)
            ->setAccountId($accountDto->getId())
            ->setAmount($amount)
            ->setTransferId(null)
            ->setCategory(TransactionCategoryEnum::DEPOSIT->value)
            ->setDate(Carbon::now())
            ->setDescription($description);
        return $dto;
    }

    public function forWithdrawal(AccountDto $accountDto, string $reference, WithdrawDto $withdrawDto): self
    {
        $dto = new TransactionDto();
        $dto->setUserId($accountDto->getUserId())
            ->setReference($reference)
            ->setAccountId($accountDto->getId())
            ->setTransferId(null)
            ->setAmount($withdrawDto->getAmount())
            ->setDate(Carbon::now())
            ->setCategory($withdrawDto->getCategory())
            ->setDescription($withdrawDto->getDescription());
        return $dto;
    }

    public function forDepositToArray(TransactionDto $transactionDto): array
    {
        return [
            'amount' => $transactionDto->getAmount(),
            'user_id' => $transactionDto->getUserId(),
            'reference' => $transactionDto->getReference(),
            'account_id' => $transactionDto->getAccountId(),
            'category' => $transactionDto->getCategory(),
            'date' => $transactionDto->getDate(),
            'description' => $transactionDto->getDescription(),
        ];
    }

    public function forWithdrawalToArray(TransactionDto $transactionDto): array
    {
        return [
            'amount' => $transactionDto->getAmount(),
            'user_id' => $transactionDto->getUserId(),
            'reference' => $transactionDto->getReference(),
            'account_id' => $transactionDto->getAccountId(),
            'category' => $transactionDto->getCategory(),
            'date' => $transactionDto->getDate(),
            'description' => $transactionDto->getDescription(),
        ];
    }
}
