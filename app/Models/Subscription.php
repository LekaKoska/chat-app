<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    const TABLE = 'subscriptions';

    protected $fillable = ['user_id', 'subscriber_id'];

    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'subscriber_id', ownerKey: 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'user_id', ownerKey: 'id');
    }
}
