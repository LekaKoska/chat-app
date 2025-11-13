<?php

namespace App\Models;

use App\Enums\FriendStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FriendConnectionModel extends Model
{
    const TABLE = 'friends_connection';
    protected $casts = ['status' => FriendStatus::class];

    protected $table = self::TABLE;
    protected $fillable = ['sender_id', 'receiver_id', 'status'];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'receiver_id');
    }
}
