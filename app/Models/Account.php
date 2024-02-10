<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property int $id
 * @property int $user_id
 * @property float $balance
 * @property string $account_number
 * @property bool $blocked
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Account extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function  owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function  transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
