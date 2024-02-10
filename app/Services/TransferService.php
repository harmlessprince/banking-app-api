<?php

namespace App\Services;

use App\Dtos\AccountDto;
use App\Dtos\TransferDto;
use App\Exceptions\ANotFoundException;
use App\Interfaces\TransferServiceInterface;
use App\Models\Account;
use App\Models\Transfer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class TransferService implements TransferServiceInterface
{

    public function modelQuery(): Builder
    {
        return Transfer::query();
    }

    public function createTransfer(TransferDto $transferDto): Transfer
    {
        /** @var Transfer $transfer */
       $transfer = $this->modelQuery()->create([
           'sender_id' => $transferDto->getSenderId(),
           'recipient_id' => $transferDto->getRecepientId(),
           'sender_account_id' => $transferDto->getSenderAccountId(),
           'recipient_account_id' => $transferDto->getRecepientAccountId(),
           'reference' => $transferDto->getReference(),
           'status' => $transferDto->getStatus(),
           'amount' => $transferDto->getAmount(),
       ]);
       return $transfer;
    }

    public function getTransfersBetweenAccount(AccountDto $firstAccountDto, AccountDto $secondAccountDto): array
    {
        // TODO: Implement getTransfersBetweenAccount() method.
    }

    public function generateReference(): string
    {
        return Str::upper('TRF' . '/' . Carbon::now()->getTimestampMs() . '/' . Str::random(4));
    }

    /**
     * @throws ANotFoundException
     */
    public function getTransferById(int $transferId): Transfer
    {
        /** @var Transfer $transfer */
        $transfer = $this->modelQuery()->where('id', $transferId)->first();
        if (!$transfer) {
            throw new ANotFoundException("Transfer not found");
        }
        return $transfer;
    }

    /**
     * @throws ANotFoundException
     */
    public function getTransferByReference(string $reference): Transfer
    {
        /** @var Transfer $transfer */
        $transfer = $this->modelQuery()->where('reference', $reference)->first();
        if (!$transfer) {
            throw new ANotFoundException("Transfer  with supplier reference not found");
        }
        return $transfer;
    }


}
