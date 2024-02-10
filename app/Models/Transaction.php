<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $account_id
 * @property int $user_id
 * @property string $reference
 * @property float $amount
 * @property string $type
 * @property string $source
 * @property bool $confirmed
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function  owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function  account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
