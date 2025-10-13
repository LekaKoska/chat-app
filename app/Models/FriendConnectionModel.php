<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendConnectionModel extends Model
{
    const TABLE = 'friends_connections';

    protected $table = self::TABLE;
    protected $fillable = ['sender_id', 'receiver_id', 'status'];

    public function sender()
    {
        return $this->belongsTo(related: User::class, foreignKey: 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(related: User::class, foreignKey: 'receiver_id');
    }
}
