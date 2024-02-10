<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $sender_id
 * @property int $sender_account_id
 * @property int $recipient_id
 * @property int $recipient_account_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Transfer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public  function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public  function senderAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'sender_account_id');
    }
    public  function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
    public  function recipientAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'recipient_account_id');
    }
}
