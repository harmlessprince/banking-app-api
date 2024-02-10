<?php

namespace App\Services;


use App\Dtos\AccountDto;
use App\Dtos\TransactionDto;
use App\Enum\TransactionCategoryEnum;
use App\Exceptions\ANotFoundException;
use App\Interfaces\TransactionServiceInterface;
use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class TransactionService implements TransactionServiceInterface
{
    /**
     * @return Builder
     */
    public function modelQuery(): Builder
    {
        return Transaction::query();
    }

    public function generateReference(): string
    {
        return Str::upper('TF' . '/' . Carbon::now()->getTimestampMs() . '/' . Str::random(4));
    }

    public function createTransaction(TransactionDto $transactionDto): Transaction
    {
        $data = [];
        if ($transactionDto->getCategory() == TransactionCategoryEnum::DEPOSIT->value) {
            $data = $transactionDto->forDepositToArray($transactionDto);
        }
        if ($transactionDto->getCategory() == TransactionCategoryEnum::WITHDRAWAL->value) {
            $data =$transactionDto->forWithdrawalToArray($transactionDto);
        }
        /** @var Transaction $transaction */
        $transaction = $this->modelQuery()->create($data);
        return $transaction;
    }





    public function downloadTransactionHistory(AccountDto $accountDto, Carbon $fromDate, Carbon $endDate): Collection
    {
        // TODO: Implement downloadTransactionHistory() method.
    }

    public function updateTransactionBalance(string $reference, float|int $balance)
    {
        $this->modelQuery()->where('reference', $reference)->update([
            'balance' => $balance,
            'confirmed' => true
        ]);
    }

    public function updateTransferID(string $reference, int $transferID)
    {
        $this->modelQuery()->where('reference', $reference)->update([
            'transfer_id' => $transferID
        ]);
    }

    /**
     * @throws ANotFoundException
     */
    public function getTransactionByReference(string $reference): Transaction
    {
        /** @var $transaction Transaction */
        $transaction =  $this->modelQuery()->where('reference', $reference)->first();
        if (!$transaction){
            throw new ANotFoundException("transaction with the supplied reference does not exist");
        }
        return $transaction;
    }

    /**
     * @throws ANotFoundException
     */
    public function getTransactionById(int $transactionID): Transaction
    {
        /** @var $transaction Transaction */
        $transaction =  $this->modelQuery()->where('id', $transactionID)->first();
        if (!$transaction){
            throw new ANotFoundException("transaction with the supplied id does not exist");
        }
        return $transaction;
    }

    public function getTransactionsByAccountNumber(int $accountNumber, Builder $builder): Builder
    {
        /** @var $transaction Transaction */
        return $builder->whereHas('account', function ($query) use ($accountNumber){
            $query->where('account_number', $accountNumber);
        });
    }

    public function getTransactionsByUserId(int $userID, Builder $builder): Builder
    {
        return $builder->where('user_id', $userID);
    }
}
