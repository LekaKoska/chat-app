<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subscription extends Model
{
    const TABLE = 'subscriptions';

    protected $fillable = ['user_id', 'subscriber_id'];

    public function subscriber(): BelongsToMany
    {
        return $this->belongsToMany(User::class, '');
    }
}
