<?php

namespace App\Dtos;

use Carbon\Carbon;

class TransferDto
{
    private  ?int $id;
    private  int $sender_id;
    private  int $sender_account_id;

    private  int $recepient_id;
    private  int $recepient_account_id;

    private float|int $amount;

    private string $status;

    private string $reference;

    private ?Carbon $created_at;
    private ?Carbon $updated_at;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getSenderId(): int
    {
        return $this->sender_id;
    }

    /**
     * @param int $sender_id
     */
    public function setSenderId(int $sender_id): void
    {
        $this->sender_id = $sender_id;
    }

    /**
     * @return int
     */
    public function getSenderAccountId(): int
    {
        return $this->sender_account_id;
    }

    /**
     * @param int $sender_account_id
     */
    public function setSenderAccountId(int $sender_account_id): void
    {
        $this->sender_account_id = $sender_account_id;
    }

    /**
     * @return int
     */
    public function getRecepientId(): int
    {
        return $this->recepient_id;
    }

    /**
     * @param int $recepient_id
     */
    public function setRecepientId(int $recepient_id): void
    {
        $this->recepient_id = $recepient_id;
    }

    /**
     * @return int
     */
    public function getRecepientAccountId(): int
    {
        return $this->recepient_account_id;
    }

    /**
     * @param int $recepient_account_id
     */
    public function setRecepientAccountId(int $recepient_account_id): void
    {
        $this->recepient_account_id = $recepient_account_id;
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
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
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
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return Carbon|null
     */
    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    /**
     * @param Carbon|null $created_at
     */
    public function setCreatedAt(?Carbon $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return Carbon|null
     */
    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
    }

    /**
     * @param Carbon|null $updated_at
     */
    public function setUpdatedAt(?Carbon $updated_at): void
    {
        $this->updated_at = $updated_at;
    }


}
